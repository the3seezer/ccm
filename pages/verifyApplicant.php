<?php $regNo=$_GET['regN'];

///Cur
//Check if user exist
$curlCert = curl_init();

//Set some options/settings
curl_setopt_array($curlCert, array(
    CURLOPT_RETURNTRANSFER => 1,

    CURLOPT_URL =>'http://196.192.79.24/oas/api/667be1b81f2d088bad299beeb9a3c993.php?value='.$regNo.'',

    CURLOPT_USERAGENT => 'WAO to MCTIS cURL Request'));

// Send the request & save response to $resp(JSON string)
if(!curl_exec($curlCert))
{
//die('Error: "' . curl_error($curlCert) . '" - Code: ' . curl_errno($curlCert));
}
else{
    $json_respCert = curl_exec($curlCert);
}

//Close request to clear up some resources
curl_close($curlCert);

//Convert JSON string to Array
$certificateArray = json_decode($json_respCert, true);

$countArr=count($certificateArray);

?>
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header"><span style="left"></h2>
    </div>
</div>
<div class="row">
    <div class="row">
        <div class="col-lg-12">

            <?php if($countArr>0){ ?>
            <div class="panel panel-success">
                <?php } else { ?>
                <div class="panel panel-danger">
                    <?php } ?>
                    <div class="panel-heading">Verified Details</div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">

                        <div class="dataTable_wrapper">
                            <?php
                            if($countArr>0)
                            {
                            foreach($certificateArray['params'] as $instData)
                            {
                            $contactID=$instData['contact'];
                            $firstname=$instData['firstname'];
                            $surname=$instData['surname'];
                            $regNo=$instData['registration_Number'];
                            $practStatus=$instData['practicing_status'];
                            $regType=$instData['registration_Type'];
                            $expDate=$instData['expiration_date']
                            ?>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                <thead>
                                <tr>
                                    <th>RegNo</th>
                                    <th>Full Name</th>
                                    <th>Registration Type</th>
                                    <th>Expiration Date</th>
                                    <th>Practicing Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="odd gradeX">
                                    <td><?php echo $regNo; ?></td>
                                    <td><?php echo $firstname." ".$surname; ?></td>
                                    <td><?php echo $regType; ?></td>
                                    <td><?php echo $expDate; ?></td>
                                    <td>
                                        <?php
                                        if($practStatus=="Allowed"){
                                            echo "<button class='btn btn-success btn-xs'>Allowed</button>";}
                                        else{
                                            echo "<button class='btn btn-danger btn-xs'>Not Allowed</button>";}
                                        ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <?php
                            //API FOR DOCUMENT DETAILS
                            //Check if user exist
                            $curlCertDoc = curl_init();

                            //Set some options/settings
                            curl_setopt_array($curlCertDoc, array(
                                CURLOPT_RETURNTRANSFER => 1,

                                CURLOPT_URL =>'http://196.192.79.24/oas/api/667be1b81f2d088bad299beeb9a3c9931234.php?value='.$contactID.'',

                                CURLOPT_USERAGENT => 'WAO to MCTIS cURL Request'));

                            // Send the request & save response to $resp(JSON string)
                            if(!curl_exec($curlCertDoc))
                            {
                                die('Error: "' . curl_error($curlCert) . '" - Code: ' . curl_errno($curlCert));
                            }
                            else{
                                $json_respCertDoc = curl_exec($curlCertDoc);
                            }

                            //Close request to clear up some resources
                            curl_close($curlCertDoc);

                            //Convert JSON string to Array
                            $documentArray = json_decode($json_respCertDoc, true);

                            $countArrDoc=count($documentArray);

                            if($countArrDoc>0)
                            {
                            ?>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Document Type</th>
                                    <th>Preview</th>
                                </tr>
                                </thead>
                                <?php
                                $i=1;
                                foreach($documentArray as $doc)
                                {
                                    $docName=$doc['docName'];
                                    $document_id=$doc['document_id'];
                                    $extension=$doc['extension'];

                                    $detail_Id=$docName.".".$extension;

                                    //API FOR DOCUMENT NAME
                                    //Check if user exist
                                    $curlCertDocN = curl_init();

                                    //Set some options/settings
                                    curl_setopt_array($curlCertDocN, array(
                                        CURLOPT_RETURNTRANSFER => 1,

                                        CURLOPT_URL =>'http://196.192.79.24/oas/api/667be1b81f2d078987688bad299beeb9a3c9931234.php?value='.$document_id.'',

                                        CURLOPT_USERAGENT => 'WAO to MCTIS cURL Request'));

                                    //Send the request & save response to $resp(JSON string)
                                    if(!curl_exec($curlCertDocN))
                                    {
                                        die('Error: "' . curl_error($curlCert) . '" - Code: ' . curl_errno($curlCert));
                                    }
                                    else{
                                        $json_respCertDocN = curl_exec($curlCertDocN);
                                    }

                                    //Close request to clear up some resources
                                    curl_close($curlCertDocN);

                                    //Convert JSON string to Array (array)
                                    $documentArrayName = json_decode($json_respCertDocN, true);

                                    $countArrDocN=count($documentArrayName);
                                    if($countArrDocN>0)
                                    {
                                        foreach($documentArrayName as $docT)
                                        {
                                            $docType=$docT['DocumentType'];
                                            ?>
                                            <tbody>
                                            <tr class='odd gradeX'>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $docType; ?></td>
                                                <td>
                                                    <a href="#previewDoctorDocu" class="btn btn-primary btn-xs"data-toggle="modal" data-id=<?php echo $detail_Id;?> id="getDocuPreview"><i class="fa fa-folder"></i> Preview</a>                                                </td>
                                            </tr>
                                            </tbody>
                                            <?php
                                        }
                                    }
                                    $i++;
                                }
                                echo "</table>";
                                }


                                }
                                }
                                else
                                {
                                    echo "Wrong RegNo, No record is found.";
                                }
                                ?>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>

            </div>




            <!--#Define Modal-->
            <!--Preview Document-->
            <div id="previewDoctorDocu" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Document Preview:</h4>
                        </div>
                        <div class="modal-body">

                            <div id="docuPreview-content"></div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>