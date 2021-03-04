const footer = document.getElementById("one")
footer.innerHTML = ""

function handleClick(){
    setTimeout(function(){
        window.location.href = "index.php?page=home"; 
    }, 10000);
    
    clearTimeout()
}