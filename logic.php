<?php

# change content
if ($gitFlag) {
    include 'git_demo_database.php';
    $db_file = 'git_demo_database.php';
    $img_src = 'git_demo_images';
} else {
    include 'database.php';
    $db_file = 'database.php';
    $img_src = 'images';
}

# get number of queues
$file = array_reverse(file($db_file));
foreach($file as $line){
    if (str_starts_with($line, '$Queue')) {
        $line = str_split($line);
        $number_of_queues = $line[6];
        break;
    }
};

#hrefIDs
$ids = array();

# MENU FUNCTION
function MenuListItem($sTD, &$idsList)
{
    $listItems = '';
    # create sectionsHeaders
    for ($y = 0; $y < count($sTD); $y++) {
        $topics = '';
        $idH = 'H-' . $y;
        $header = "<li><a class='navyHover' name='header' id=" . $idH . "><strong>" . $sTD[$y][0] . "</strong></a><ul class='hidden'>";
        # create nested items
        for ($x = 0; $x < count($sTD[$y]); $x++) {
            if ($x == 0) {
                continue;
            };
            $hrefID = $sTD[$y][0] . '-' . $x;
            $topic = "<li><a class='navyHover' href=#" . $hrefID . ">" . $sTD[$y][$x] . "</a></li>";
            $topics .= $topic;
            # creates key => value array
            $idsList[$sTD[$y][$x]] = $hrefID;
        };
        $closureTags = "</ul></li>";
        $listItem = $header . $topics . $closureTags;
        $listItems .= $listItem;
    };
    echo $listItems;
}

## CONTENT FUNCTIONS ##

# echo styled header
function SectionHeader($header)
{
    echo "<h1 class='title is-1 header navy' name='sectionHeader'>" . $header . "</h1>";
}

# echo styled topic
function SectionTopic($topic, $ids)
{
    $topicID = $ids[$topic];
    echo "<h2 class='title is-2 header navy' name='topicHeader' id=" . $topicID . ">" . $topic . "</h2>";
}

# echo styled text paragraphs 
function TextArea($text)
{
    echo "<p class='textArea navy'>" . $text . "</p>";
}

# echo styled topic footer
function SeeAlsoFooter($ids, ...$refTopics)
{
    $footerBase = "<p class='myFooter navy'>▶ <strong>Zobacz także:</strong>";
    $iter = 0;
    foreach ($refTopics as $refTopic) {
        $hrefID = $ids[$refTopic];
        $iter++;
        if ($iter == 1) {
            $frmtLink = " " . "<a href=#" . $hrefID . ">" . $refTopic . "</a>";
        } else {
            $frmtLink = ", " . "<a href=#" . $hrefID . ">" . $refTopic . "</a>";
        };
        $footerBase .= $frmtLink;
    };
    echo $footerBase . "</p>";
}

# echo styled image
function Image($img_src, $imgURL)
{
    echo "<figure class='image is-16by9 margined'><img src=".$img_src."/" . $imgURL . "></figure>";
}

## END CONTENT FUNCTIONS ##


# queue (array-) merging section queues (-of arrays)
$MainQueue = array();
for ($x = 0; $x <= $number_of_queues; $x++) {
    $g = 'Queue'.$x;
    $MainQueue[] = $$g;
}

# footers (array) containing complete calls to echo footer
$footers = array();
foreach ($footer_hrefs as $hrefs) {
    $footers[] = 'SeeAlsoFooter($ids, '.$hrefs.');';
}

?>