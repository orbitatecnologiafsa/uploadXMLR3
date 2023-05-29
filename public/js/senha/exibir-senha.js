function checado(el){
    let checkbox = $('#senhaShow');
    if (checkbox.is(":checked")) {
        $('#password').prop('type', 'text') 
    } else {
        $('#password').prop('type', 'password')    
    }
}
function submit(el){
    $("#submit-form").click(function(){
        $('#password').prop('type', 'password')  
    });
}

$document.ready(function(){
    $("#documento").on('keyup'(function(){
        var docuemento = $('#documento').val();
        alert(docuemento)
    }))
    
});

$( "#documento" ).keyup(function() {
    alert( "Handler for .keyup() called." );
  });