<?php
//fe tork kteer mnha el array 34an el languages
function lang($phrase){
    $lang = array(
        //navbar1 links
        'HOMEPAGE'          => "HomePage",
        'SEARCH'            => "Search",
        //navbar2 links
        'LOGIN/SIGNUP'      => "Login / SignUp",
        'MYPROFILE'         => "my profile",
        'NEWAD'             => "New Ad",
        'MYITEMS'           => "My Items",
        'WISHLIST'          => "Wishlist",
        'LOGOUT'            => "Logout",
        //my profile links
        'MYINFO'            => "My Info",
        'USERNAME'          => "UserName: ",
        'EMAIL'             => "Email: ",
        'FULLNAME'          => "FullName: ",
        'REGISTERDATE'      => "Register Date: ",
        'STATUS'            => "Status: ",
        'NOTACTIVATED'      => "Not Activated",
        'ACTIVATED'         => "Activated",
        'MYADS'             => "My Ads",
        'MYCOMMENTS'        => "My Comments",
        'EDITINFO'          => "Edit Info",
        'WAITINGAPPROVAL'   => "Waiting Approval",
        //New Ad links
        'NEWADVERTISMENT'       => "New Advertisment",
        'NAME'                  => "Name",
        'DESCRIPTION'           => "Description",
        'categories'            => "Categories",
        'ADD ITEMS'             => "Add Item",
        'PLACEHOLDER9'          => "Name Of The Items",
        'PLACEHOLDER10'         => "Describe The Item",
        'TAGS'                  => "Tags",
        'PLACEHOLDER20'         => "Separate Tags With Comma (,)",
        'PRICE'                 => "Price",
        'PLACEHOLDER11'         => "You Should Put The Price with The Currency ex:100$",
        'COUNTRY'               => "Country Name: ",
        'PLACEHOLDER12'         => "Country Of Origin",
        'STATUS'                => "Status",
        'NEW'                   => "New",
        'LIKE NEW'              => "Like New",
        'USED'                  => "Used",
        'MEMBERS'               => "Member",
        // ITEMS LINK
        'COMPAREWITHITEM'       => "Compare With Item",
        'COMPARE'               => "Compare ",
        'INFO'                  => "Info: ",
        'STATUS:'               => "Status: ",
        'CATEGORY'              => "category: ",
        'ADDEDBY'               => "Added By: ",
        'ADDTOCART'             => "Add To Cart",
        'ADDYOURCOMMENT'        => "Add Your Comment",
        'ADDCOMMENT'            => "Add Comment",
        'PLACEHOLDER25'         => "There Is No Comment On This Item To Show",
    );
    return $lang[$phrase];
}
