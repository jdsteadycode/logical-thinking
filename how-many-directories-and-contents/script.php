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
          
        
          // save each sub dir..
          $subDirs[$index] = [
              "name" => $dir['name'],
              "id" => $dir['id'],
              "sub_dirs" => [],
          ];
          
          
          // get sub dirs of sub dir itself available..
          $subDirs[$index]['sub_dirs'] = getSubDirectories($dir['id'], $data);
        
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
