<div id='wrap' class='wrap'>
    <?php echo wrap_top() ?>
        <p>Click any of the slot title texts to change what it says.</p>
        <p>
            <input id='start' type='button' value='Insert Coin'>
            <input id='stop' type='button' value='Stop'>
            <input id='screenshot' type='button' value='Screenshot'>
            <input id='reset' type='button' value='Reset Titles'>
        </p>
    </div>
    <table id='table'>
        <tr>
            <td id='title0' class='title'>You are a ...</td>
            <td id='title1' class='title'>Best friend</td>
            <td id='title2' class='title'>Hates you</td>
        </tr>
        <tr>
            <td id='slot0'></td>
            <td id='slot1' class='slot charslot_1'></td>
            <td id='slot2' class='slot charslot_1'></td>
        </tr>
        <tr>
            <td id='title3' class='title'>First kiss</td>
            <td id='title4' class='title'>Has a crush on you</td>
            <td id='title5' class='title'>Married to</td>
        </tr>
        <tr>
            <td id='slot3' class='slot charslot_1'></td>
            <td id='slot4' class='slot charslot_1'></td>
            <td id='slot5' class='slot charslot_1'></td>
        </tr>
        <tr>
            <td id='title6' class='title'>Honeymoon location</td>
            <td id='title7' class='title'>No. of children</td>
            <td id='title8' class='title'>Cockblocked by</td>
        </tr>
        <tr>
            <td id='slot6' class='slot locslot'></td>
            <td id='slot7'></td>
            <td id='slot8' class='slot charslot_1'></td>
        </tr>
    </table>
    <div id='bottom' data-html2canvas-ignore>
        <p>Credit to an unknown original creator for the idea of this randomiser.</p>
        <p>Originally known as Touhou Click and Drag Game.</p>
    </div>
    <?php
        $json = file_get_contents('assets/other/slots/json/charpos.json');
        $chars = json_decode($json, true);
        $json = file_get_contents('assets/other/slots/json/locs.json');
        $locs = json_decode($json, true);
        foreach ($chars as $key => $array) {
            echo '<div id="chars' . $key . '_load" data-html2canvas-ignore>';
            foreach ($array as $key => $name) {
                echo '<input id="' . $key . '" type="hidden" value="' . $name . '">';
            }
        }
        echo '</div><div id="locs_load" data-html2canvas-ignore>';
        foreach ($locs as $key => $name) {
            echo '<input id="' . $key . '" type="hidden" value="' . $name . '">';
        }
        echo '</div>';
    ?>
</div>
<div id='modal' data-html2canvas-ignore>
    <div id='modal_inner'></div>
</div>
