<?php
//fe tork kteer mnha el array 34an el languages
function lang($phrase){
    $lang = array(
        //navbar1 links
        'HOMEPAGE'          => "الصفحة الرئيسية",
        'SEARCH'            => "بحث",
        //navbar2 links
        'LOGIN/SIGNUP'      => "تسجيل الدخول / إنشاء حساب",
        'MYPROFILE'         => "صفحتي الشخصية",
        'NEWAD'             => "إعلان جديد",
        'MYITEMS'           => "إعلاناتي",
        'WISHLIST'          => "قائمة الرغبات",
        'LOGOUT'            => "تسجيل الخروج",
        //my profile links
        'MYINFO'            => "بياناتي",
        'USERNAME'          => " :اسم الدخول",
        'EMAIL'             => " :البريد الإلكتروني",
        'FULLNAME'          => " :الأسم بالكامل",
        'REGISTERDATE'      => " :تاريخ تسجيل الدخول",
        'STATUS'            => " :الحالة",
        'NOTACTIVATED'      => "غير مفعل",
        'ACTIVATED'         => "مفعلة",
        'MYADS'             => "إعلاناتي",
        'MYCOMMENTS'        => "تعليقاتي",
        'EDITINFO'          => "تعديل البيانات",
        'WAITINGAPPROVAL'   => "إنتظار الموافقة",
        //New Ad links
        'NEWADVERTISMENT'       => "إعلان جديد",
        'NAME'                  => " :الاسم",
        'DESCRIPTION'           => " :الوصف",
        'categories'            => " :الفئة",
        'ADD ITEMS'             => "إضافة إعلان",
        'PLACEHOLDER9'          => "إسم الإعلان",
        'PLACEHOLDER10'         => "وصف الإعلان",
        'TAGS'                  => " :التاجات",
        'PLACEHOLDER20'         => "إفصل بين التاجات بفاصل (,)",
        'PRICE'                 => " :السعر",
        'PLACEHOLDER11'         => "ضع السعر بدون العملة",
        'COUNTRY'               => " :اسم البلد",
        'PLACEHOLDER12'         => "اكتب اسم بلد المنشأ",
        'NEW'                   => "جديد",
        'LIKE NEW'              => "مثل الجديد",
        'USED'                  => "مستعمل",
        'MEMBERS'               => "عضو",
        // ITEMS LINK
        'COMPAREWITHITEM'       => "المقارنة بإعلان أخر",
        'COMPARE'           => "مقارنة الإعلان",
        'INFO'                  => "البيانات",
        'ADDEDBY'               => " :إضافة بواسطة",
        'ADDTOCART'             => "إضافة إلي السلة",
        'CATEGORY'              => " :فئة",
        'ADDYOURCOMMENT'        => "ضع تعليقا",
        'ADDCOMMENT'            => "إضافة التعليق",
        'PLACEHOLDER25'         => "لا يوجد تعليق لهذا الإعلان",
    );
    return $lang[$phrase];
}
