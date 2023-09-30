const butao = document.querySelector("#butao")

butao.addEventListener("click", function () {
    $.ajax({
        url: "arquivo.php",
        method: "POST",
        success: function (response) {
            downloadFile("guias.zip", response)
        }
    });
})

async function downloadFile(filename, content) {
    const zip = new JSZip();
    await zip.loadAsync(content, {base64: true});
    const blob = await zip.generateAsync({type:"blob"});

    const element = document.createElement("a");
    element.setAttribute("href", window.URL.createObjectURL(blob));
    element.setAttribute("download", filename);
    element.style.display = "none";
    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
}
