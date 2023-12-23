$(document).ready(function() {
  $('#summernote').summernote({
      placeholder:'Hello there',
      height:200
  });
});


$(document).ready(function(){
   $('#selectAllBoxes').click(function(e){
        if(this.checked){
            
            $('.checkBoxes').each(function(){
                this.checked = true;
            })
        }else{
            
            $('.checkBoxes').each(function(){
                this.checked = false
            })
        }
   })
})