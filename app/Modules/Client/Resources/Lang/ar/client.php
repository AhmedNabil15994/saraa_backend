<?php

return array (
  'title' => 'العملاء',
  'newOne' => 'اضافة عميل جديد',
  'form' => 
  array (
    'name' => 'الاسم',
    'status' => 'الحالة',
    'mobile' => 'رقم الهاتف',
    'email' => 'البريد الالكتروني',
    'password' => 'كلمة المرور',
    'password_confirmation' => 'تأكيد كلمة المرور',
    'role' => 'المجموعة',
    'last_login' => 'اخر عملية تسجيل دخول',
    'extra_permissions' => 'الصلاحيات',
    'first_name' => 'الاسم الاول',
    'last_name' => 'الاسم الاخير',
    'image' => 'الصورة الشخصية',
    'change_image_p' => 'تغيير صورة العميل',
    'stores' => 'المتاجر',
    'validations' => 
    array (
      'email_required' => 'البريد الالكتروني مطلوب!',
      'email_email' => 'صيغة البريد الإلكتروني غير صحيح!',
      'email_unique' => 'تم استخدام البريد الإلكتروني بالفعل!',
      'name_required' => 'اسم المستخدم مطلوب!',
      'mobile_required' => 'رقم الهاتف مطلوب!',
      'mobile_unique' => 'تم استخدام رقم الهاتف بالفعل!',
      'role_id_unique' => 'المجموعة مطلوب!',
      'password_required' => 'كلمة المرور مطلوبة!',
      'password_confirmed' => 'كلمة السر غير متطابقة!',
      'password_min' => 'يجب أن تتكون كلمة المرور من 6 أحرف على الأقل!',
      'store_required' => 'يرجي اختيار المتجر للعميل',
    ),
  ),
);
