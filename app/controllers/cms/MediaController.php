<?php

use App\Models\User;
use App\Models\Media;
use Kernel\Requests\FileRequest;

class MediaController extends Auth
{

    /**
     * Controller Index
     *
     * @return mixed
     **/
    public function index()
    {
        $media = Media::order('id', 'desc')->get();

        return render('backend/media/index', compact('media'));
    }


    /**
     * Controller Fetch
     *
     * @return mixed
     **/
    public function fetch($limit, $order, $search)
    {
        if ($search == '__EMPTY__') {
            if ($limit == 'All') {
                $files = Media::order('id', $order)->get();
            } else {
                $files = Media::order('id', $order)->limit($limit)->get();
            }
        } else {
            $query = new Database;
            $limit = $limit == 'All' ? '' : "LIMIT $limit";
            $articles = $query->query("
                SELECT * 
                FROM media 
                WHERE name LIKE ? 
                OR extension LIKE ? 
                OR type LIKE ? 
                ORDER BY id {$order} 
                {$limit}",
                [$search,
                    "%$search%",
                    "%$search%",
                ]);
        }

        echo <<<EOF
        <table id="table" class="table table-sm display">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Size</th>
                <th>Upload Date</th>
                <th>Uploaded by</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
EOF;

        foreach ($files as $file):
            $author = User::find($file->user_id);
            $download = r('cms.media.download',$file->id);
            $hardlink = BASE_URL . "assets/media/$file->name";

            echo "
            <tr>
                <td>{$file->id}</td>
                <td>{$file->name}</td>
                <td>{$file->extension}</td>
                <td>".to_megabytes($file->size)."Mb</td>
                <td>".date('F j, Y', $file->created)."</td>
                <td>{$author->firstname} {$author->lastname}</td>
                <td>
                    <button class='btn btn-xs btn-warning' onclick=\"prompt('Hard link: ', '$hardlink')\">Hard link</button> |
                    <a class='btn btn-xs btn-info' href=\"$download\">Download</a>
                </td>
            </tr>";
        endforeach;
        echo "</tbody></table>";
    }


    /**
     * Controller Download
     *
     * @return mixed
     **/
    public function download($id)
    {
        $media = Media::find($id);

        return download_file(assets_path() . 'media/' . $media->name);
    }


    /**
     * Controller Create
     *
     * @return mixed
     **/
    public function upload()
    {
        return render('backend/media/create');
    }


    /**
     * Controller Create
     *
     * @return mixed
     **/
    public function store()
    {
        $upload_path = assets_path() . 'media/';
        $request = $_FILES['file_upload'];
        $size = 0;

        if (isset($_FILES['file_upload']) && empty($request['name'][0])) {
            setflash("message", "<i class='text-danger'>Please select a file.</i>");
        } else {
            for ($s = 0; $s < count($request['size']); $s++):
                $size += $request['size'][$s];
            endfor;

            if ($size >= 41943040) {
                setflash("message", "<i class='text-danger'>File(s) size should be 20MB or less.</i>");
            } else {
                for ($i = 0; $i < count($request['tmp_name']); $i++):
                    $filename = $request['name'][$i];

                    if (file_exists($upload_path . $filename)) {
                        $filename = pathinfo($request['name'][$i], PATHINFO_FILENAME) . '_' .
                            time() . '.' .
                            file_extension($request['name'][$i]);
                    }

                    if (move_uploaded_file($request['tmp_name'][$i], $upload_path . $filename)) {
                        Media::insert([
                            'user_id' => isset(Session::user()->id) ? Session::user()->id : null,
                            'name' => $filename,
                            'extension' => file_extension($request['name'][$i]),
                            'type' => $request['type'][$i],
                            'size' => $request['size'][$i],
                            'created' => time(),
                            'updated' => time(),
                        ]);
                        setflash("message", "<i class='text-success'>File(s) were uploaded successfully.</i>");
                    } else {
                        setflash("message", "<i class='text-danger'>There was an error uploading the file, contact system administrator.</i>");
                    }
                endfor;
            }
        }

        return redirect(r('cms.media.upload'));
    }
}
