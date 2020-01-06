<?php
$lt = exec('git describe --tags `git rev-list --tags --max-count=1`');

if(!empty(exec('git describe --exact-match --tags $(git log -n1 --pretty="%h")'))) {
    die('Current Status has already a tag.');
}

$tag = explode('.', $lt);

if(count($tag) == 2) {
    $tag[2] = 1;
}
else {
    $tag[count($tag) - 1] = $tag[count($tag) - 1] + 1;
}
$newTag = implode('.', $tag);

$result = exec('git tag -a ' . $newTag . ' -m "Version ' . $newTag . '"');
exec('git push origin --tags');
