<?php
// $Rev: 174 $
error_reporting(E_ALL);
include_once('../simple_html_dom.php');

$dir = './html/';

$files = array(
    array('name'=>'empty.htm',          'url'=>''),
    array('name'=>'smarty_1.htm',       'url'=>'guestbook.tpl'),
    array('name'=>'smarty_2.htm',       'url'=>'guestbook_form.tpl'),
    
    array('name'=>'google.htm',         'url'=>'https://www.google.com/'),
    array('name'=>'senate.htm',         'url'=>'https://www.senate.gov/legislative/LIS/roll_call_lists/roll_call_vote_cfm.cfm?congress=101&session=2&vote=00317'),
    array('name'=>'cyberciti.htm',      'url'=>'https://www.cyberciti.biz/tips/configure-ubuntu-grub-to-load-freebsd.html'),
    array('name'=>'myspace.htm',        'url'=>'https://www.myspace.com/'),
    array('name'=>'mootools.htm',       'url'=>'https://www.mootools.net/'),
    array('name'=>'jquery.htm',         'url'=>'https://jquery.com/'),
    array('name'=>'scriptaculo.htm',    'url'=>'https://script.aculo.us/'),
    array('name'=>'apache.htm',         'url'=>'https://www.apache.org/'),
    array('name'=>'microsoft.htm',      'url'=>'https://www.microsoft.com/'),
    array('name'=>'slashdot.htm',       'url'=>'https://www.slashdot.org/'),
    array('name'=>'ror.htm',            'url'=>'https://www.rubyonrails.org/'),
    array('name'=>'yahoo.htm',          'url'=>'https://www.yahoo.com/'),
    array('name'=>'phpbb.htm',          'url'=>'https://www.phpbb.com/'),
    array('name'=>'python.htm',         'url'=>'https://www.python.org/'),
    array('name'=>'lua.htm',            'url'=>'https://www.lua.org/'),
    array('name'=>'php.htm',            'url'=>'https://www.php.net/'),
    array('name'=>'ibm.htm',            'url'=>'https://www.ibm.com/'),
    array('name'=>'java.htm',           'url'=>'https://java.sun.com/'),
    array('name'=>'flickr.htm',         'url'=>'https://www.flickr.com/tour/upload/'),
    array('name'=>'amazon.htm',         'url'=>'https://www.amazon.com/'),
    array('name'=>'youtube.htm',        'url'=>'https://www.youtube.com/watch?v=kib05Ip6GSo&feature=bz302'),
);


echo 'memory: '.memory_get_usage().'<br>';
$dom = new simple_html_dom;

foreach($files as $f) {
    // get file from url
    if($f['url']!='') file_put_contents($dir.$f['name'], file_get_contents($f['url']));
    else file_put_contents($dir.$f['name'], '');

    $start = microtime();
    $dom->load(file_get_contents($dir.$f['name']), false);
    list($eu, $es) = explode(' ', microtime());
    list($bu, $bs) = explode(' ', $start);
    echo sprintf('(%.1f)', ((float)$eu+(float)$es-(float)$bu-(float)$bs)*1000).'<br>';
    
    if (file_get_contents($dir.$f['name'])!=$dom->save()) {
        echo "[<font color='red'>failed</font>] ".$f['name']."<br>";
        $dom->save($dir.$f['name'].'.error');
    }
    else
        echo "[success] ".$f['name']."<br>";

    echo 'memory: '.memory_get_usage().'<br>';

    flush();
    set_time_limit(0);
}

$dom->clear();
unset($dom);
echo '<br>memory: '.memory_get_usage().'<br>';

?>