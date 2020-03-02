<script src="//cdn.ckeditor.com/4.12.1/basic/ckeditor.js"></script>

CKEDITOR.replace( 'blogDetails' );
var blogDetails = CKEDITOR.instances.blogDetails.getData();
CKEDITOR.instances.editblogDetails.setData($(this).data('blog_details'));
