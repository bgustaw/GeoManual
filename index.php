<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Dokumentacja</title>
    <link rel="shortcut icon" href="https://geo.mat.expert/images/favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body class="bodyStyle">

    <?php
    $gitFlag = True;

    $header = 'SectionHeader($sTD[$i][$t++]);';
    $topic = 'SectionTopic($sTD[$i][$t++], $ids);';
    $textArea = 'TextArea($SECTION[$j++]);';
    $image = 'Image($img_src,"$section".$f++.".png");';
    $footer = 'eval($footers[$r++]);';
    
    
    include 'logic.php';

    ?>

    <!--Top nav bar-->
    <!--Visible when: screen.width <= 768px-->
    <div id="mobileNav" class='bottomBorder hidden'>
        <div id='mobileMenu'>
            <a id='mobileTrigger' class='title is-3'>▼ Jak korzystać?</a>
        </div>
        <ul class="menu-list hidden">
            <?php MenuListItem($sTD, $ids) ?>
        </ul>
    </div>
    <div class="columns is-mobile">
        <!--Left nav bar menu-->
        <!--Visible when: screen.width > 768px-->
        <div class="column is-one-fifth menuMargined" id='columnSideMenu'>
            <figure class="image is-2by1">
                <?php echo '<img src='.$img_src.'/logo.png>'?>
            </figure>
            <aside class="menu sticky" id="sideMenu">
                <p class="menu-label">
                    Jak korzystać?
                </p>
                <ul class="menu-list">
                    <?php MenuListItem($sTD, $ids) ?>
                </ul>
            </aside>
        </div>
        <!--Main content container-->

        <div class="column is-four-fifth contentMargined">
            <div>
                <?php
                    // $r - footers index iterator
                    // $i - sections index iterator
                    // $t - topics index iterator
                    // $j - textarea index iterator
                    // $f - images index iterator
                    $r = 0;
                    for ($i = 0; $i <= $number_of_queues; $i++) {
                        $t = 0; $j = 0; $f = 1;
                        $SECTION = $sTD[$i][$t];
                        $section = strtolower($SECTION);
                        $SECTION = $$SECTION;

                        eval($header) ;
                        echo "<div class='container'>";
                        foreach ($MainQueue[$i] as $block_content) {
                            eval($block_content);
                        }
                        echo '</div>';
                    }
                ?>
            </div>

        </div>
        
    </div>

    <script src="static.js"></script>

</body>

</html>