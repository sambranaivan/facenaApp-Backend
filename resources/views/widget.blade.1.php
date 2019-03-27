<div>
<script>
function getData(){
    $.get('localhost/facena/widget',{},function(data){
        console.log(data);
    });
}
</script>
<button onclick="getData()">test</button>

</div>
