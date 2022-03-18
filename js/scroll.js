async function scroll(id) {
    await sleep(600);
    document.getElementById(id).scrollIntoView({ behavior: 'auto', block: 'center', inline: 'center' });
    await sleep(600);
    document.getElementById(id).style.transform = "scale(105%)";
    await sleep(1000);
    document.getElementById(id).style.transform = "scale(100%)";
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}