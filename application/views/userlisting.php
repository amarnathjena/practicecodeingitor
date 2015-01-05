    <h3>User Listing</h3>
<fieldset>
<table border="0" class="width100" style="text-align: center;">
    <tr>
        <th>
            Name
        </th>
        <th>
            Date of Birth
        </th>
        <th>
            Permanent Address
        </th>
        <th>
            Action
        </th>
    </tr>
<?php 
foreach($lists as $key=>$val){
    echo "<tr>
        <td>
            ".ucwords($val->name)."
        </td>
        <td>
            ".date("d-m-Y", strtotime($val->dob))."
        </td>
        <td>
            ".ucfirst($val->permanent_address)."
        </td>
        <td>
            <a href='javascript:void(0);' onClick='editUser(\"".$val->id."\")'>Edit</a>
            <a href='javascript:void(0);' onClick='deleteUser(\"".$val->id."\", this)'>Delete</a>
        </td>
    </tr>";
}
echo "</table></fieldset>";
include "footer.php";?>

 <script type="text/javascript">
     function editUser(id){
        var url="<?php echo base_url()."index.php/login/registrationform/";?>";
        $.post(url, {"user":id, "noheader":1}, function (res){
           $.fancybox(res, {"width":1000,
           'onComplete':function(){
               $("#dob").datepicker({
                    "dateFormat":"dd-mm-yy"
                });
           }});
        });
     }
     function deleteUser(id, curobj){
         $.post("<?php echo base_url()."index.php/login/deleteUser";?>", {"id":id}, function(res){
             $(curobj).parents("tr").remove();
             if(res=='success')
                $("#sessmsg").html("Successfully deleted a user's record");
             setTimeout(function(){
                $("#sessmsg").html("");
            },3000);
         });
     }
 </script>