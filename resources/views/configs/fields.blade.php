<script src='//cdn.ckeditor.com/4.5.10/standard/ckeditor.js'></script>

<div class="form-body">
<!-- Max Height Field -->
<div class="form-group m-b-40 ">
{!! Form::text('max_height', null, ['class' => 'form-control','id'=>"max_height","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('max_height', ' اقصي طول بال سم') !!}                                                
 </div>



<!-- Max Width Field -->
<div class="form-group m-b-40 ">
{!! Form::text('max_width', null, ['class' => 'form-control','id'=>"max_width","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('max_width', ' اقصي عرض بال سم') !!}
 </div>



<!-- Max Length Field -->
<div class="form-group m-b-40 ">
{!! Form::text('max_length', null, ['class' => 'form-control','id'=>"max_length","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('max_length', ' اقصي ارتفاع بال سم') !!}
 </div>


<!-- Max Length Field -->
<div class="form-group m-b-40 ">
{!! Form::text('max_weight', null, ['class' => 'form-control','id'=>"max_weight","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('max_weight', ' اقصي وزن بال كجم') !!}
 </div>
 
 
<!-- Dvided Ratio Field -->
<div class="form-group m-b-40 ">
{!! Form::text('dvided_ratio', null, ['class' => 'form-control','id'=>"dvided_ratio","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('dvided_ratio', 'مقدار النسبة') !!}
 </div>

     <!-- Max Length Field -->
     <div class="form-group m-b-40 ">
         {!! Form::text('delivery_commission', null, ['class' => 'form-control','id'=>"delivery_commission","required"]) !!}
         <span class="highlight"></span> <span class="bar"></span>
         {!! Form::label('delivery_commission', 'عمولة المندوب لكل رحلة بال جنية المصري') !!}
     </div>

    <!-- Max Length Field -->
    <div class="form-group m-b-40 ">
        {!! Form::text('collected_commission', null, ['class' => 'form-control','id'=>"collected_commission","required"]) !!}
        <span class="highlight"></span> <span class="bar"></span>
        {!! Form::label('collected_commission', 'العمولة بالنسبة المئوية لاسترجاع المبلغ') !!}
    </div>


     <!--  cancelation_cost Field -->
     <div class="form-group m-b-40 ">
         {!! Form::text('cancelation_cost', null, ['class' => 'form-control','id'=>"cancelation_cost","required"]) !!}
         <span class="highlight"></span> <span class="bar"></span>
         {!! Form::label('cancelation_cost', 'تكلفة الغاء الطلب للعميل') !!}
     </div>


<!-- Max Hour Ship Field -->
<div class="form-group m-b-40 ">
{!! Form::text('max_hour_ship', null, ['class' => 'form-control','id'=>"timehours","required"]) !!}
     <span class="highlight"></span> <span class="bar"></span>
{!! Form::label('max_hour_ship', 'اقفال توصيل اليوم في الساعة') !!}
 </div>





     <div class="form-group m-b-40 ">
        <textarea class='form-control' name='rules_ar' id="rules_ar" required>
        <?php if(isset($config)) echo $config->rules_ar; ?></textarea>
         <span class="highlight"></span> <span class="bar"></span>
         {!! Form::label('rules_ar', 'سياسة الاستخدام عربي') !!}


         <script type='text/javascript'>



             CKEDITOR.replace( 'rules_ar', {

                 extraAllowedContent : 'table{background,background-color}',

                 colorButton_enableMore : false,
                 colorButton_colors : 'CF5D4E,454545,FFF,CCC,DDD,CCEAEE,66AB16',
                 colorButton_enableAutomatic : false,

                 colorButton_foreStyle : {

                     element: 'span', styles: { color: '#(color)' }

                 },

                 colorButton_backStyle : {

                     element: 'span', styles: { 'background-color': '#(color)' }

                 },

                 toolbarCanCollapse : true,
                 pasteFromWordPromptCleanup : true,
                 pasteFromWordRemoveFontStyles : false,
                 pasteFromWordNumberedHeadingToList : false,
                 pasteFromWordRemoveStyles : false,
                 allowedContent: true,
                 on: {
                     instanceReady: function( evt ) {
                         var editor = evt.editor;


                     }
                 }
             } );

         </script>

     </div>



     <div class="form-group m-b-40 ">
        <textarea class='form-control' name='rules_en' id="rules_en" required>
        <?php if(isset($config)) echo $config->rules_en; ?></textarea>
         <span class="highlight"></span> <span class="bar"></span>
         {!! Form::label('rules_en', 'سياسة الاستخدام انجليزي') !!}


         <script type='text/javascript'>



             CKEDITOR.replace( 'rules_en', {

                 extraAllowedContent : 'table{background,background-color}',

                 colorButton_enableMore : false,
                 colorButton_colors : 'CF5D4E,454545,FFF,CCC,DDD,CCEAEE,66AB16',
                 colorButton_enableAutomatic : false,

                 colorButton_foreStyle : {

                     element: 'span', styles: { color: '#(color)' }

                 },

                 colorButton_backStyle : {

                     element: 'span', styles: { 'background-color': '#(color)' }

                 },

                 toolbarCanCollapse : true,
                 pasteFromWordPromptCleanup : true,
                 pasteFromWordRemoveFontStyles : false,
                 pasteFromWordNumberedHeadingToList : false,
                 pasteFromWordRemoveStyles : false,
                 allowedContent: true,
                 on: {
                     instanceReady: function( evt ) {
                         var editor = evt.editor;


                     }
                 }
             } );

         </script>

     </div>






    <div class="form-group m-b-40 ">
        <textarea class='form-control' name='about_us_ar' id="about_us_ar" required>
        <?php if(isset($config)) echo $config->about_us_ar; ?></textarea>
        <span class="highlight"></span> <span class="bar"></span>
        {!! Form::label('about_us_ar', 'عن الشركة عربي') !!}


        <script type='text/javascript'>



            CKEDITOR.replace( 'about_us_ar', {

                extraAllowedContent : 'table{background,background-color}',

                colorButton_enableMore : false,
                colorButton_colors : 'CF5D4E,454545,FFF,CCC,DDD,CCEAEE,66AB16',
                colorButton_enableAutomatic : false,

                colorButton_foreStyle : {

                    element: 'span', styles: { color: '#(color)' }

                },

                colorButton_backStyle : {

                    element: 'span', styles: { 'background-color': '#(color)' }

                },

                toolbarCanCollapse : true,
                pasteFromWordPromptCleanup : true,
                pasteFromWordRemoveFontStyles : false,
                pasteFromWordNumberedHeadingToList : false,
                pasteFromWordRemoveStyles : false,
                allowedContent: true,
                on: {
                    instanceReady: function( evt ) {
                        var editor = evt.editor;


                    }
                }
            } );

        </script>

    </div>




    <div class="form-group m-b-40 ">
        <textarea class='form-control' name='about_us_en' id="about_us_en" required>
        <?php if(isset($config)) echo $config->about_us_en; ?></textarea>
        <span class="highlight"></span> <span class="bar"></span>
        {!! Form::label('about_us_en', 'عن الشركة انجليزي') !!}


        <script type='text/javascript'>



            CKEDITOR.replace( 'about_us_en', {

                extraAllowedContent : 'table{background,background-color}',

                colorButton_enableMore : false,
                colorButton_colors : 'CF5D4E,454545,FFF,CCC,DDD,CCEAEE,66AB16',
                colorButton_enableAutomatic : false,

                colorButton_foreStyle : {

                    element: 'span', styles: { color: '#(color)' }

                },

                colorButton_backStyle : {

                    element: 'span', styles: { 'background-color': '#(color)' }

                },

                toolbarCanCollapse : true,
                pasteFromWordPromptCleanup : true,
                pasteFromWordRemoveFontStyles : false,
                pasteFromWordNumberedHeadingToList : false,
                pasteFromWordRemoveStyles : false,
                allowedContent: true,
                on: {
                    instanceReady: function( evt ) {
                        var editor = evt.editor;


                    }
                }
            } );

        </script>

    </div>


</div>
<div class="form-actions" style="margin-top:20px;">
    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> حفظ</button>
    <a href="{!! route('configs.index') !!}" class="btn btn-default">الغاء</a>
</div>