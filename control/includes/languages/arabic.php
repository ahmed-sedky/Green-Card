<?php
//fe tork kteer mnha el array 34an el languages
function lang($phrase){
    $lang = array(
        // NAVBAR LINKS
        'Admin_Home' => "الصفحة الرئيسية",
        'company'    => "نايك",
        'categories' => "الأقسام",
        'ITEMS'      => "بنود",
        'Members'    => "أعضاء",
        'COMMENTS'   => "التعليقات",
        'STATISTICS' => "إحصائيات",
        'LOGS'       => "دخول",
        'username'   =>  $_SESSION['username'],
        'edit-profile'  => "تعديل الصفحة الشخصية",
        'settings'      => "إعدادات",
        'language'      => "اللغة",
        'log_out'       => "تسجيل الخروج",
        'VISIT SHOP'    => "زيارة المتجر",
        //edit member
        'EDIT MEMBER'   =>  "تعديل بياناتي الخاصة",
        'PASSWORD'      => "كلمة المرور",
        'FULLNAME'      => "الإسم بالكامل",
        'IMAGE'         => "صورة",
        'EMAIL'         => " البريد الإلكتروني",
        'USERNAME'      => "اسم الدخول",
        'SAVE'          => "حفظ",
        'UPDATE_MEMBER' =>  "تحديث عضو",

        'error1'        => "<div class= 'alert alert-danger '>اسم الدخول لا يجب أن يقل عن <strong>4 حروف</strong> </div>",
        'error2'        => "<div class= 'alert alert-danger '>لا يسمح لخانة إسم الدخول أن  <strong> تكون فارغة</strong></div>",
        'error3'        => "<div class= 'alert alert-danger '>لا يسمح لخانة لبريد الإلكتروني أن  <strong> تكون فارغة</strong></div>",
        'error4'        => "<div class= 'alert alert-danger '>لا يسمح لخانة الإسم بالكامل أن  <strong> تكون فارغة</strong></div>",
        'error5'        => "<div class= 'alert alert-danger '>كلمة المرور لا يجب أن تقل عن  <strong>6 حروف</strong></div>",
        'error6'        => "<div class= 'alert alert-danger '>اسم الدخول لا يجب أن يزيد عن  <strong>4 حرف</strong></div>",
        'PLACEHOLDER1'  => "اترك هذه الخانة فارغة إذا لم ترد تغير كلمة المرور",
        //ADD member
        'ADD MEMBER'   =>  "إضافة عضو",
        'PLACEHOLDER2' => "اسم الدخول المستخدم لتسجيل الدخول للمتجر",
        'PLACEHOLDER3' => "كلمة اللمرور يجب أن تكون صعبة ومعقدة",
        'PLACEHOLDER4' => "البريد الإلكترومي يجب أن يكون صحيحا",
        'PLACEHOLDER5' => "الاسم بالكامل الذي سيظهر في صفحتك الشخصية",
        //INSERT MEMBER
        'INSERT_MEMBER'=> "إدخال عضو",
        'error7'        => "<div class= 'alert alert-danger '>لا يسمح لخانة كلمة المرور أن  <strong> تكون فارغة</strong></div>",
        //MANAGE MEMBERS
        'ADD_MEMBER'   =>  "إضافة عضو جديد",
        'MANAGE MEMBER'=>  "إدارة عضو ",
        'EDIT'         =>  "تعديل",
        'DELETE'       =>  "حذف",
        'ID'           =>  "#البطاقة التعريفية",
        'REGISTER DATE'=>  "تاريخ التسجيل",
        'CONTROL'      =>  "تحكم",
        //delete MEMBERS
        "DELETE MEMBER"=>  "حذف عضو",
        // ACTIVATE MEMBERS
        'ACTIVE'       => "فعل",
        //check items
        'CHECK1'       => " معذرة هذا الإسم موجود مسبقا",
        'CHECK2'       => " هذا البريد الإلكتروني مستخدم من قبل",
        //dashboard
        'DASHBOARD'         => 'لوحة القيادة',
        'TOTAL MEMBERS'     => 'مجموع الأعضاء',
        'PENDING MEMBERS'   => 'الأعضاء قيد الإنتظار',
        'TOTAL ITEMS'       => 'مجموع العناصر',
        'TOTAL COMMENTS'    => 'مجموع التعليقات',
        'LATEST REGISTERED USERS'      => 'أخر الأعضاء المسجلين',
        'LATEST ITEMS'      => 'أخر العناصر',
        // ACTIVATE MEMBER 
        'ACTIVATE MEMBER'   => "تفعيل عضو ",
        //Add category
        'ADD NEW CATEGORY'  => "إضافة فئة جديدة",
        'ADD CATEGORY'      => "إضافة فئة",
        'NAME'              => "الاسم",
        'DESCRIPTION'       => "الوصف",
        'PARENT'            =>  "الأب",
        'ORDERING'          => "الترتيب",
        'VISIBILITY'        => "السماح بالظهور",
        'ALLOW COMMENTS'    => "  السماح بالتعليقات",
        'ALLOW ADS'         => "  السماح بالإعلانات",
        'PLACEHOLDER6'      => "",
        'PLACEHOLDER7'      => "",
        'PLACEHOLDER8'      => "",
        'YES'               => "نعم",
        'NO'                => "لا",
        //INSERT CATEGORY
        'INSERT CATEGORY'   => "إدخال فئة",
        //error insert category
        'error8'        => "<div class= 'alert alert-danger '>لا يسمح لخانة إسم الفئة أن  <strong> تكون فارغة</strong></div>",
        //check in insert category
        'CHECK3'       => " معذرة هذا الإسم موجود مسبقا",   
        //MANAGE CATEGORIES
        'MANAGE CATEGORIES'     =>"إدارة الفئات",
        'VISIBLE'               =>"  ظاهر",
        'HIDDEN'                => "  مخفي",
        'DISALLOW COMMENTS'     => "  غير مسموح للتعليقات",
        'DISALLOW ADS'          => "  غير مسموح للإعلانات",
        'OREDRING'              => "  الترتيب",
        'ASC'                   => " تصاعدي",
        'DESC'                  => " تنازلي",
        //EDIT CATEGORY
        'EDIT CATEGORY'         => "إضافة فئة",
        //'UPDATE CATEGORY
        'UPDATE CATEGORY'       => "تحديث فئة",
        //'DELETE CATEGORY
        'DELETE CATEGORY'       => "حذف فئة",
        //ADD ITEMS
        'ADD NEW ITEMS'         => "إضافة بند جديد",
        'ADD ITEMS'             => "إضافة بند",
        'PLACEHOLDER9'          => "اسم البند",
        'PLACEHOLDER10'         => "وصف البند",
        'PRICE'                 => "السعر",
        'TAGS'                  => "التاجات",
        'PLACEHOLDER20'         => "افصل بين التاجات بفاصل(,)",
        'PLACEHOLDER11'         => "$ يجب أن تكتب السعر مع وجود العملة مثال:100",
        'COUNTRY'               => "اسم البلد",
        'PLACEHOLDER12'         => "بلد المنشأ",
        'STATUS'                => "الحالة",
        'NEW'                   => "جديدة",
        'LIKE NEW'              => "مثل الجديد",
        'USED'                  => "مستعملة",
        'MEMBERS'               => "العضو",
        // insert items
        'INSERT ITEMS'          => "إدخال بند",
        'error9'        => "<div class= 'alert alert-danger '>لا يسمح لخانة إسم البند أن  <strong> تكون فارغة</strong></div>",
        'error10'        => "<div class= 'alert alert-danger '>لا يسمح لخانة السعر أن  <strong> تكون فارغة</strong></div>",
        'error11'        => "<div class= 'alert alert-danger '>لا يسمح لخانة بلد المنشأ أن  <strong> تكون فارغة</strong></div>",
        'error12'        => "<div class= 'alert alert-danger '>لا يسمح لخانة الحالة أن  <strong> تكون فارغة</strong></div>",
        'error13'        => "<div class= 'alert alert-danger '>لا يسمح لخانة العضو أن  <strong> تكون فارغة</strong></div>",
        'error14'        => "<div class= 'alert alert-danger '>لا يسمح لخانة الفئة أن  <strong> تكون فارغة</strong></div>",
        //MANAGE ITEMS
        'MANAGE ITEMS'          => "إدارة البنود",
        'ADDING DATE'           => "تاريخ االإضافة",
        'COUNTRY MADE'          => "بلد المنشأ",
        'RATING'                => "التقييم",
        'ADD ITEM'              => "إضافة بند",
        'CATEGORY'              => "فئة",
        'CLIENTNAME'            => "اسم العميل",
        //EDIT ITEM
        'EDIT ITEM'             => "تعديل فئة",
        'SAVE ITEM'             => "حفظ فئة",
        //update ITEM
        'UPADTE ITEM'           => "تحديث فئة",
        //DELETE ITEM
        'DELETE ITEM'           => "حذف فئة",
        //APPROVE ITEM  
        'APPROVE ITEM'          => "الموافقة علي فئة",
        'APPROVE'               => "موافقة", 
        //MANAGE COMMENTS
        'MANAGE COMMENTS'       => "إدارة التعليقات", 
        'ID'                    => "البطاقة التعريفية",
        'COMMENT'               => "التعليق",
        'ITEM NAME'             => "اسم البند",
        'USER NAME'             => "اسم العضو",
        'ADDED DATE'            => "تاريخ الإضافة",
        //EDIT COMMENTS
        'EDIT COMMENT'          => "تعديل تعليق",
        //UPDATE COMMENTS
        'UPDATE COMMENT'        => "تحديث تعليق",
        //DELETE COMMENTS
        'DELETE COMMENT'        => "حذف تعليق",
        //APPROVE COMMENT
        'APPROVE COMMENT'       => "قبول تعليق",
        'SHOW COMMENTS'         => "إظهار التعليقات",
        //LATEST COMMENTS
        'LATEST COMMENTS'       => "أخر التعليقات",
    );
    return $lang[$phrase];
}
