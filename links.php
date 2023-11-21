<?php
    $filename = 'links';
    if($argc >= 2) {
        $filename = $argv[1];
    }
    $links = file_get_contents('links.txt');
    $template = file_get_contents('links-template.html');
    $pagecontent = '';
    $md = '';
    $html = '';
    $links = explode("\n", $links);
    $links = array_filter($links);
    $links = array_map('trim', $links);
    $links = array_unique($links);
    $size = count($links);
    $current = 0;
    foreach ($links as $k=>$l) {
        $num = ($current+1);
        echo "$num/$size Fetching $l\n";
        // $pagecontent = file_get_contents($l);
        // $pagecontent = exec('curl -s -L '.$l);
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, $l);
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        $pagecontent = curl_exec($curlSession);
        curl_close($curlSession);
        $title = preg_match('/<title>(.*?)<\/title>/is', $pagecontent, $matches) ? $matches[1] : '';
        echo $title."\n";
        $title = trim($title);
        $html .= "\n       <li><a href=\"$l\">$title</a></li>";
        $md .= "* [$title]($l)\n";
        $current++;
    }
    file_put_contents($filename.'.html', str_replace('<!--links-->', $html, $template));
    file_put_contents($filename.'.md', $md);
    echo "Wrote $filename.html and $filename.md\n"
    ?>