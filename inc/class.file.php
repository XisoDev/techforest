<?php
class FileHandler
{
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