// -----------------------------------------------------------------------------
// MetaDataExport
// -----------------------------------------------------------------------------
function isChecked( checkboxId )
{
    var checkBox = document.getElementById( checkboxId );
    
    if ( checkBox )
    {
        return checkBox.checked;
    }
    
    return false;
}
function setMessage( message )
{
	if ( (message != "") && (message != null) )
	{
		$( '#message' ).html( message );
		$( '#message' ).slideDown( 'fast' );
	}
}
function hideMessage()
{
	$( '#message' ).slideUp( 'fast' );
}

function submitMetaDataExportForm()
{
    if ( validateMetaDataExportForm() )
    {
       document.getElementById( "exportMetaDataForm" ).submit();
       setMessage( "Data exported successfully!" );
    }
}

function toggle( knob )
{
    var toggle = false;
	
    if ( knob == "all" )
    {
        toggle = true;
    }
	
    document.getElementById( "fields" ).checked = toggle;
    document.getElementById( "fieldGroups" ).checked = toggle;
    document.getElementById( "fieldOptions" ).checked = toggle;
    document.getElementById( "fieldOptionGroups" ).checked = toggle;
    document.getElementById( "indicators" ).checked = toggle;
    document.getElementById( "forms" ).checked = toggle;
    document.getElementById( "organisationUnits" ).checked = toggle;
    document.getElementById( "organisationUnitGroups" ).checked = toggle;
}

// -----------------------------------------------------------------------------
// Validation
// -----------------------------------------------------------------------------

function validateMetaDataExportForm()
{
    if (
        !isChecked( "fields" ) &&
        !isChecked( "fieldGroups" ) &&
        !isChecked( "fieldOptions" ) &&
        !isChecked( "fieldOptionGroups" ) &&
        !isChecked( "indicators" ) &&
        !isChecked( "resourceTables" ) &&
        !isChecked( "forms" ) &&
        !isChecked( "organisationUnits" ) &&
        !isChecked( "organisationUnitGroups" ) )
     {
         setMessage( "Please select one or more meta data to export" );
         return false;
     }
     return true;
}
