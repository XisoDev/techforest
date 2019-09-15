<?php
class FileHandler
{

    /**
     * get file list by xiso
     * @param $path
     * @return $file_list array
     */
    function getFileList($dir_path, $valid_formats = array("jpg", "png", "gif")){
        $dir = _XISO_PATH_.$dir_path;
        $file_list = array();

        if(!is_array($valid_formats)) $valid_formats = explode(",",$valid_formats);
        // 디렉토리에 있는 파일과 디렉토리의 갯수 구하기
        $result = opendir($dir); //opendir 함수를 이용해서 디렉토리의 핸들을 얻어옴

        // readdir함수로 지정 디렉토리에 있는 디렉토리와 파일들의 이름을 배열로 읽어들임
        while($file = readdir($result)) {
            if($file === "."|| $file === "..") continue; // file명이 ".", ".." 이면 무시함
            $getExt = pathinfo($file, PATHINFO_EXTENSION); // 파일의 확장자를 구함

            if(!empty($getExt)){
                if(in_array($getExt, $valid_formats)){
                    $file_list[] = $file;
                }
            }
        }
        return $file_list;
    }

    /**
     * getFileList 에 count만 추가한 alias
     */
    function getFileCount($dir_path, $valid_formats = array("jpg", "png", "gif")){
        return count(self::getFileList($dir_path, $valid_formats));
    }

    function getRealPath($source)
    {
        global $tpath;

        if(strlen($source) >= 2 && substr_compare($source, './', 0, 2) === 0)
        {
            return _XISO_PATH_ . substr($tpath, 2) . substr($source, 2);
        }

        return $source;
    }

    /**
     * Remove a file
     *
     * @param string $filename path of target file
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    function removeFile($filename)
    {
        return (($filename = self::exists($filename)) !== FALSE) && @unlink($filename);
    }

    /**
     * Check file exists.
     *
     * @param string $filename Target file name
     * @return bool Returns FALSE if the file does not exists, or Returns full path file(string).
     */
    function exists($filename)
    {
        $filename = self::getRealPath($filename);
        return file_exists($filename) ? $filename : FALSE;
    }

    /**
     * Returns the content of the file
     *
     * @param string $filename Path of target file
     * @return string The content of the file. If target file does not exist, this function returns nothing.
     */
    function readFile($filename)
    {
        if(($filename = self::exists($filename)) === FALSE || filesize($filename) < 1)
        {
            return;
        }

        return @file_get_contents($filename);
    }
}
?>