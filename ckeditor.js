<script src="//cdn.ckeditor.com/4.12.1/basic/ckeditor.js"></script>

CKEDITOR.replace( 'blogDetails' );
var blogDetails = CKEDITOR.instances.blogDetails.getData();
CKEDITOR.instances.editblogDetails.setData($(this).data('blog_details'));

// get ckeditor value by class
var ckID = $(this).find('.cke').attr('id').substring(4);
var ckFun = 'CKEDITOR.instances.'+ckID+'.getData()';
var cost_wise_accommodation = eval(ckFun);
data.append('cost_wise_accommodation', cost_wise_accommodation);
