<?php
/*
I had to write these routines to highlight spellings in a WYSIWYG editor.
pspell() barfed at HTML tags and entities, so this code deals with them. 
ClearSpell() allows you to clear up the spellchecker mark up afterwards.*/
?>
<html>
<head>
<style>
acronym.spell
{
text-decoration:underline;
color:red;
cursor:help;
}
</style>
</head>
<body>
<?php
    $t = "<font color=blue>text herre &amp; some more</font>";
    echo "Before:$t";
    $t = SpellCheck($t);
    echo "<hr>After SpellCheck: $t";
    $t = ClearSpell($t);
    echo "<hr>After ClearSpell: $t";
?>
</body>
</html>

<?php

function SpellCheck($text)
{
//depends on fnSpell()
// Extracts text from HTML code. In addition to normal word separators,  HTML tags
// and HTML entities also function as word delimiters

    $pspell_link = pspell_new("en_GB"); //0. Get the dictionary
    $strings = explode(">", $text);  //1. Split $text on '>' to give us $strings with 0 or 1 HTML tags at the end
    $nStrings = count($strings);

    for ($cStrings=0; $cStrings < $nStrings; $cStrings++)
    {
        $string = $strings[$cStrings]; //2. For each string from 1

        if ($string =='')
            continue;

        $temp  = explode('<', $string); //2.1   Split $string from $strings on '>' to give us a $tag and $cdata
        $tag = $temp[1];
        $cdata = $temp[0];

        $subCdatas = explode(";", $cdata);  //2.2 Split &cdata on ';' to give $subcdatas with 0 or 1 HTML entities on the end
        $nSubCdatas = count($subCdatas);    //2.3   For each $subCdata from $subcdatas in 2.2

        for ($cSubCdatas = 0; $cSubCdatas < $nSubCdatas; $cSubCdatas++)
        {
            $subCdata = $subCdatas[$cSubCdatas];

            if ($subCdata == '')
                continue;

            $temp = explode('&', $subCdata); //2.3.1     Split the $subCdata on '&' to give us a $subCdataEntity and a $subCdataWithNoEntities
            $subCdataEntity = $temp[1];
            $subCdataWithNoEntities = $temp[0];
            $subCdataWithNoEntities = fnSpell($pspell_link, $subCdataWithNoEntities); //2.3.2     Spellcheck the $cdataWithNoEntities

            if (!$subCdataEntity ) //2.3.3        Put the $subCdataEntity, a '&' and the $cdataWithNoEntities back into the $subCdata from 2.2
                $subCdata = $subCdataWithNoEntities;
            else
                $subCdata = $subCdataWithNoEntities. '&' . $subCdataEntity . ';' ;

            $subCdatas[$cSubCdatas] = $subCdata; //2.3.4        Put the $subCdata back into the array of $subCdatas
        }

        $cdata = implode("", $subCdatas); //2.4    Implode the array of $subCdatas back into the $cdata

        if ($tag) //2.5    Put the $tag , '>' and $cdata back into $string
            $string = $cdata . '<' . $tag . '>';
        else
            $string = $cdata;

        $strings[$cStrings] = $string; //2.6    Put $string back in its place in $strings
    }

    $text = implode('', $strings);     //3  Implode the $strings back into $text
    return $text;

}

function fnSpell($pspell_link, $string)
{

   preg_match_all("/[A-Z\']{1,16}/i", $string, $words);

   for ($i = 0; $i < count($words[0]); $i++)
   {
        $currentword = $words[0][$i];

        if (!pspell_check($pspell_link, $currentword))
        {
            $wordarray = pspell_suggest($pspell_link, $currentword);
                $words = implode(', ', $wordarray);
                $suggest = "<acronym class='spell' title='$words'>$currentword</acronym class='spell'>";
            $string = str_replace($currentword, $suggest, $string);
        }

    }
    return $string;
}

function ClearSpell($text)
{
    $strings = explode(">", $text); 
    $nStrings = count($strings);

    for ($cStrings=0; $cStrings < $nStrings; $cStrings++) 
    {
        $string = $strings[$cStrings];

        if ($string =='')
            continue;

        $temp  = explode('<', $string); 
        $tag = $temp[1];
        $cdata = $temp[0];

        if ( strstr($tag, 'acronym') && strstr($tag, "class='spell'") )
            $string = $cdata;
        else
            $string = $cdata . '<' . $tag . '>';

        $strings[$cStrings] = $string; 
    }

    $text = implode('', $strings); 
    return $text;
}
?>