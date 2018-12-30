<?php
//判断当前请求是否为post方式
function isPost()
{
    return ($_SERVER['REQUEST_METHOD'] == 'POST'
        && (empty($_SERVER['HTTP_REFERER']) || preg_replace("~https?:\/\/([^\:\/]+).*~i", "\\1", $_SERVER['HTTP_REFERER']) == preg_replace("~([^\:]+).*~", "\\1", $_SERVER['HTTP_HOST']))) ? 1 : 0;
}

/**
 * 获取文件扩展名
 * @param string $path
 * @return mixed|string
 */
function getFileExt($path = '')
{
    if (empty($path)) {
        return '';
    }
    $arr = explode('.', $path);
    return array_pop($arr);
}
