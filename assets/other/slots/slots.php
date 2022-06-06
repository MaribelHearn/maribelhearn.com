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
            <td id='slot1' class='slot charslot'></td>
            <td id='slot2' class='slot charslot'></td>
        </tr>
        <tr>
            <td id='title3' class='title'>First kiss</td>
            <td id='title4' class='title'>Has a crush on you</td>
            <td id='title5' class='title'>Married to</td>
        </tr>
        <tr>
            <td id='slot3' class='slot charslot'></td>
            <td id='slot4' class='slot charslot'></td>
            <td id='slot5' class='slot charslot'></td>
        </tr>
        <tr>
            <td id='title6' class='title'>Honeymoon location</td>
            <td id='title7' class='title'>No. of children</td>
            <td id='title8' class='title'>Cockblocked by</td>
        </tr>
        <tr>
            <td id='slot6' class='slot locslot'></td>
            <td id='slot7'></td>
            <td id='slot8' class='slot charslot'></td>
        </tr>
    </table>
    <div id='bottom' data-html2canvas-ignore>
        <p>Credit to an unknown original creator for the idea of this randomiser.</p>
        <p>Originally known as Touhou Click and Drag Game.</p>
    </div>
</div>
<div id='modal' data-html2canvas-ignore>
    <div id='modal_title' class='modal_inner'>
        <h2>Change Title</h2>
        <p><input id='custom_title' type='text' value=''><small id='title_length'></small></p>
        <p><input id='change_title' type='button' value='Change'></p>
    </div>
    <div id='modal_screenshot' class='modal_inner'>
        <h2>Screenshot</h2>
        <p><a id='save_link' href='' download=''><input type='button' value='Save to Device'></a></p>
        <p><img id='screenshot_base64' src='' alt='Slot machine screenshot'></p>
    </div>
</div>
