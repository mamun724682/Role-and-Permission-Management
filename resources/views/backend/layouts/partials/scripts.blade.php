<script>
         /**
         * Check all the permissions
         */
         $("#checkPermissionAll").click(function(){
           if($(this).is(':checked')){
                 // check all the checkbox
                 $('input[type=checkbox]').prop('checked', true);
               }else{
                 // un check all the checkbox
                 $('input[type=checkbox]').prop('checked', false);
               }
             });
         function checkPermissionByGroup(className, checkThis){
          const groupIdName = $("#"+checkThis.id);
          const classCheckBox = $('.'+className+' input');
          if(groupIdName.is(':checked')){
           classCheckBox.prop('checked', true);
         }else{
           classCheckBox.prop('checked', false);
         }

         implementAllChecked()
       }

       function checkSinglePermission(groupClassName, groupId, countTotalPermissions) {
         const classCheckBox = $('.' + groupClassName + ' input');
         const groupIdCheckBox = $('#' + groupId);

         if ($('.' + groupClassName + ' input:checked').length == countTotalPermissions) {
          groupIdCheckBox.prop('checked', true);
         } else {
          groupIdCheckBox.prop('checked', false);
         }

         implementAllChecked()
       }

       function implementAllChecked() {
         const countPermissions = {{ count($all_permissions) }}
         const countPermissionsGroups = {{ count($permissions_groups) }}

         if ($('input[type="checkbox"]:checked').length >= (countPermissions + countPermissionsGroups)) {
          $('#checkPermissionAll').prop('checked', true);
         } else {
          $('#checkPermissionAll').prop('checked', false);
         }
       }
     </script>