<?php session_start();
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$cc_id = $_POST['cc_id'];
$sc_id = $_POST['sc_id'];

//Get cadre by cadre_id
$getCadre = $db->getListofCadreCriteriaFromCCById($cc_id);
$row = $getCadre->fetch();

$criteria_id = $row['criteria_id'];
$credit = $row['credit'];
$criteriaName = $row['criteriaName'];
$cadre_id = $row['cadre_id'];

$sel1 = $db->getListCriteria();
?>

<form action="includes/process.php" method="post" class="form-horizontal form-label-left">


    <div class="item form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Criteria<span class="required">*</span></label>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <select id="criteria" class="form-control col-md-6 col-xs-12" name="criteria"
                    required="required" onchange="loadStandardNames(this.value)">
                <option value="">--Select--</option>
                <?php
                while ($row1 = $sel1->fetch()) {
                    ?>
                    <option value="<?php echo $row1['criteriaId']; ?>" <?php echo $row1['criteriaId'] == $cc_id ? 'selected' : '' ?>><?php echo $row1['criteriaName']; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
            <input id="number" class="form-control col-md-6 col-xs-12" name="credit" required="required" type="text" pattern="[0-9]+" title="please enter number only"
                   value="<?php echo $credit; ?>">
        </div>
    </div>


    <div id="standardNames"></div>


    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <input type="submit" id="send" class="btn btn-success" name="editCadreCriteria"
                   value="Save"/>
            <input type="reset" class="btn btn-default" value="Clear"/>
            <input type="hidden" name="cadre_id" value="<?php echo $cadre_id; ?>"/>
            <input type="hidden" name="cc_id" value="<?php echo $cc_id; ?>"/>

        </div>
    </div>
</form>

<script>
    setTimeout(() => {
        let event = new Event('onchange');
        let element = document.getElementById('criteria');
        element.addEventListener('onchange', function (e) {
            let id = "<?=$cc_id ?>";
            loadStandardNames(id);

            setTimeout(() =>{
                if (sc_id === 6){
                    let high = "<?=$row['higher_age'] ?>";
                    let low = "<?=$row['lower_age'] ?>";
                    document.getElementById('fromYear').value = low;
                    document.getElementById('endYear').value = high;
                }

                if(sc_id === 7){
                    let doc = document.getElementById('gender');
                    let value = "<?=$row['gender'] ?>";
                    let event = new Event('onchange');
                    doc.addEventListener('onchange', function () {
                        console.log(this.options);
                        for(let i=0; i < this.options.length; i++)
                        {
                            if(this.options[i].value == value)
                                this.selectedIndex = i;
                        }
                    });

                    doc.dispatchEvent(event);
                }


            },100)
        }, false);
        element.dispatchEvent(event);
    }, 200);

    let sc_id = <?php echo $sc_id ?>;


</script>