<?php
//fe tork kteer mnha el array 34an el languages
function lang($phrase){
    $lang = array(
        //navbar links
        'Admin_Home'    => "Home",
        'company'       => "Nike",
        'categories'    => "Categories",
        'ITEMS'         => "Items",
        'Members'       =>"Members",
        'COMMENTS'      => "Comments",
        'STATISTICS'    => "Statisitics",
        'LOGS'          => "Logs",
        'username'      =>  $_SESSION['username'],
        'edit-profile'  => "Edit Profile",
        'settings'      => "Settings",
        'language'      => "Language",
        'log_out'       => "Log Out",
        'VISIT SHOP'    => "Visit Shop",
        //edit member
        'EDIT MEMBER'   =>  "Edit Member",
        'PASSWORD'      => "Password",
        'FULLNAME'      => "Full Name",
        'IMAGE'         => "Image",
        'EMAIL'         => " Email",
        'USERNAME'      => "UserName",
        'SAVE'          => "Save",
        'UPDATE_MEMBER'=>  "Update Member",

        'error1'        => "<div class= 'alert alert-danger '>the User Name Can't be Less Than <strong> 4 charcters </strong></div>",
        'error2'        => "<div class= 'alert alert-danger '>the UserName can't <strong>be empty</strong></div>",
        'error3'        => "<div class= 'alert alert-danger '>the Email can't <strong>be empty</strong></div>",
        'error4'        => "<div class= 'alert alert-danger '>the Fullname can't <strong>be empty</strong></div>",
        'error5'        => "<div class= 'alert alert-danger '>the Password can't be less than <strong>6 charcters</strong></div>",
        'error6'        => "<div class= 'alert alert-danger '>the User Name Can't be More Than<strong> 20 charcters</strong></div>",
        'PLACEHOLDER1'  => "Leave It If You Want The Same Password",
        //ADD member
        'ADD MEMBER'   =>  "Add Member",
        'PLACEHOLDER2' => "UserName to login to the shop",
        'PLACEHOLDER3' => "Password must Be Hard & Complex",
        'PLACEHOLDER4' => "Email Must Be Valid",
        'PLACEHOLDER5' => "Full Name To Appear In The Profile Page",
        //INSERT MEMBER
        'INSERT_MEMBER'=> "Insert Member",
        'error7'        => "<div class= 'alert alert-danger '>the password Can't <strong>empty</strong></div>",
        //MANAGE MEMBERS
        'ADD_MEMBER'   =>  "Add New Member",
        'MANAGE MEMBER'=>  "Manage Member",
        'EDIT'         =>  "Edit",
        'DELETE'       =>  "Delete",
        'ID'           =>  "#ID",
        'REGISTER DATE'=>  "Register Date",
        'CONTROL'      =>  "Control",
        //delete MEMBERS
        "DELETE MEMBER"=>  "Delete Member",
        // ACTIVATE MEMBERS
        'ACTIVE'       => "Activate",
        // CHECK ITEMS
        'CHECK1'       => "Sorry, This UserName Has Been Already Exist ",
        'CHECK2'       => "Sorry, This Email Has Been Already Exist ",
        //dashboard
        'DASHBOARD'         => 'DashBoard',
        'TOTAL MEMBERS'     => 'Total Members',
        'PENDING MEMBERS'   => 'Pending Members',
        'TOTAL ITEMS'       => 'Total Items',
        'TOTAL COMMENTS'    => 'Total Comments',
        'LATEST REGISTERED USERS'      => 'Latest Registerd Users',
        'LATEST ITEMS'      => 'Latest Items',
        // ACTIVATE MEMBER 
        'ACTIVATE MEMBER'   => "Activate Member",
        //Add category
        'ADD NEW CATEGORY'  => "Add New Category",
        'ADD CATEGORY'      => "Add Category",
        'NAME'              => "Name",
        'DESCRIPTION'       => "DescriPtion",
        'PARENT'            =>  "Parent",
        'ORDERING'          => "Ordering",
        'VISIBILITY'        => "Visible",
        'ALLOW COMMENTS'    => "  Allow Comments",
        'ALLOW ADS'         => "  Allow Advertisments",
        'PLACEHOLDER6'      => "Name Of The Category",
        'PLACEHOLDER7'      => "Describe The Category",
        'PLACEHOLDER8'      => "Number To Arrange The Category",
        'YES'               => "Yes",
        'NO'                => "No",
        //INSERT CATEGORY
        'INSERT CATEGORY'   => "Insert Category",
        //error form in insert category
        'error8'        => "<div class= 'alert alert-danger '>the Category Name can't <strong>be empty</strong></div>",
        //check in insert category
        'CHECK3'       => "Sorry, This Name Has Been Already Exist ",
        //MANAGE CATEGORIES
        'MANAGE CATEGORIES'     =>"Manage Categories",
        'VISIBLE'               => "  Visible",
        'HIDDEN'                => "  Hidden",
        'DISALLOW COMMENTS'     => "  Comments Disallowed",
        'DISALLOW ADS'          => "  Ads Disallowed",
        'OREDRING'              => "  Ordering",
        'ASC'                   => " Asc",
        'DESC'                  => " Desc",
        //EDIT CATEGORY
        'EDIT CATEGORY'         => "Edit Category",
        //'UPDATE CATEGORY
        'UPDATE CATEGORY'       => "Update Category",
        //'DELETE CATEGORY
        'DELETE CATEGORY'       => "Delete Category",
        //ADD ITEMS
        'ADD NEW ITEMS'         => "Add New Items",
        'ADD ITEMS'             => "Add Items",
        'PLACEHOLDER9'          => "Name Of The Items",
        'PLACEHOLDER10'         => "Describe The Item",
        'TAGS'                  => "Tags",
        'PLACEHOLDER20'         => "Separate Tags With Comma (,)",
        'PRICE'                 => "Price",
        'PLACEHOLDER11'         => "You Should Put The Price with The Currency ex:100$",
        'COUNTRY'               => "Country Name",
        'PLACEHOLDER12'         => "Country Of Origin",
        'STATUS'                => "Status",
        'NEW'                   => "New",
        'LIKE NEW'              => "Like New",
        'USED'                  => "Used",
        'MEMBERS'               => "Member",
        //INSERT ITEMS
        'INSERT ITEMS'          => "Insert Items",
        'error9'                => "<div class= 'alert alert-danger '>the Item's Name can't <strong>be empty</strong></div>",
        'error10'               => "<div class= 'alert alert-danger '>the Price can't <strong>be empty</strong></div>",
        'error11'               => "<div class= 'alert alert-danger '>the Country can't <strong>be empty</strong></div>",
        'error12'               => "<div class= 'alert alert-danger '>the Status can't <strong>be empty</strong></div>",
        'error13'               => "<div class= 'alert alert-danger '>the Member  can't <strong>be empty</strong></div>",
        'error14'               => "<div class= 'alert alert-danger '>the Category can't <strong>be empty</strong></div>",
        //MANAGE ITEMS
        'MANAGE ITEMS'          => "Manage Items",
        'ADDING DATE'           => "Adding Date",
        'COUNTRY MADE'          => "country Made",
        'RATING'                => "Rating",
        'ADD ITEM'              => "Add Item",
        'CATEGORY'              => "Category",
        'CLIENTNAME'            => "Client Name",
        //EDIT ITEM
        'EDIT ITEM'             => "Edit Item",
        'SAVE ITEM'             => "Save Item",
        //update ITEM
        'UPADTE ITEM'           => "Update Item",
        //update ITEM
        'DELETE ITEM'           => "Delete Item",
        //APPROVE ITEM  
        'APPROVE ITEM'          => "Approve Item",
        'APPROVE'               => "Approve",
        //MANAGE COMMENTS
        'MANAGE COMMENTS'       => "Manage Comments",
        'ID'                    => "Id",
        'COMMENT'               => "Comment",
        'ITEM NAME'             => "Item Name",
        'USER NAME'             => "Member Name",
        'ADDED DATE'            => "Added Date",
        //EDIT COMMENTS
        'EDIT COMMENT'          => "Edit Comments",
        //UPDATE COMMENTS
        'UPDATE COMMENT'        => "Update Comments",
        //DELETE COMMENTS
        'DELETE COMMENT'        => "Delete Comments",
        //APPROVE COMMENT
        'APPROVE COMMENT'       => "Approve Comment",
        'SHOW COMMENTS'         => " Show Comments",
        //LATEST COMMENTS
        'LATEST COMMENTS'       => "Latest Comments",
    );
    return $lang[$phrase];
}
