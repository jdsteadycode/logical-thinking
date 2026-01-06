<?php

// data
$directories = [
    ['id' => 1, 'name' => 'root',   'parent_id' => null],
    ['id' => 2, 'name' => 'src',    'parent_id' => 1],
    ['id' => 3, 'name' => 'config', 'parent_id' => 1],
    ['id' => 4, 'name' => 'http', 'parent_id' => 2],
    ['id' => 5, 'name' => 'views',  'parent_id' => 2],
    ['id' => 6, 'name' => 'controllers', 'parent_id' => 4]
];

// () -> get list of sub directories..
function getSubDirectories(int $parentId, array $data) {
    // initial data..
    $subDirs = [];

    // iterate over the data..
    foreach($data as $index => $dir) {

        // check for parent id..
        if($dir['parent_id'] !== null 
          && 
        ((int) $dir['parent_id'] === (int)$parentId)) {
          
          // check log..
          // print_r($dir);
          
          // check log
          // var_dump($dir['id'], getSubDirectories($dir['id'], $data));
          
          // check log
        
          // save each sub dir..
          $subDirs[] = [
              "name" => $dir['name'],
              "id" => $dir['id'],
              "sub_dirs" => getSubDirectories($dir['id'], $data),
          ];
          
          
          // // get sub dirs of sub dir itself available..
          // $subDirs[]['sub_dirs'] = getSubDirectories($dir['id'], $data);
        
        }
        
    }
    
    

    // get final list of sub dirs..
    return $subDirs;
}

// TEST
// echo json_encode(getSubDirectories(2, $directories), JSON_PRETTY_PRINT);


// () -> get dir structure..
function getDirStructure(array $data) {

    // initial array of root dirs..
    $dirs = [];

    // iterate over the data..
    foreach($data as $dir) {

        // check if dir is root..
        if($dir['parent_id'] === null) {

            // save the dir
            $dirs[] = [
                "name" => $dir['name'],
                "id" => $dir['id'],
                "sub_dirs" => getSubDirectories((int) $dir['id'], $data)
            ];
        }
    }

    // get the final root dirs..
    return $dirs;
}

// TEST
// echo json_encode(getDirStructure($directories), JSON_PRETTY_PRINT);

// TEST
// echo json_encode(folderStructure($directories), JSON_PRETTY_PRINT);

// get the folder data..
$data = getDirStructure($directories);

// () -> render sub directories..
function renderSubDirectories(array $dirs) {

    // initial clutter 
    $clutter = "";

    // if dirs are empty
    if(empty($dirs)) {
        return "";
    }

    // iterate over sub directories..
    foreach($dirs as $dir) {

        // get sub directories of child also
        $subDirs = renderSubDirectories($dir['sub_dirs']);
        
        // check log..
        // var_dump($subDirs);

        // get name of child dir..
        $dirName = $dir['name'];

        // save each dir data in clutter..
        $clutter .= <<<HTML
            <ul>
                <li>$dirName</li>
                <ul>$subDirs</ul>
            </ul>
        HTML;
    }

    // get html with data.
    return $clutter;
}

// () -> render directories..
function renderDirectories(array $data) {

    // initial html
    $clutter = "";

    // iterate over the data..
    foreach($data as $dir) {

        // get name of root dir..
        $rootDirName = $dir['name'];
        $rootDirId = $dir['id'];

        // get sub directories associated with..
        $subDirs = renderSubDirectories($dir['sub_dirs']);

        // add basic dir details to clutter
        $clutter .= <<<HTML
            <ul>
                <li>$rootDirName</li>
                $subDirs
            <ul>
        HTML;  
    }

    // get the data with clutter..
    return $clutter;
}


// check..
$dirs = renderDirectories($data);
?>

<html>
    <body>
        <h1>HTML CONTENT</h1>

        <div>
            <ul>
                <?= $dirs ?>
            </ul>
        </div>
    </body/>
</html>


