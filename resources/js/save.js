import { saveAs } from 'file-saver';
import * as htmlToImage from 'html-to-image';
import * as JSZip from 'jszip';

const tables = document.getElementsByTagName("table");
//
const yellow = [240, 250, 60],
    green = [39, 130, 3],
    red = [212, 28, 4];

for(let i = 0; i < tables.length; i++){
    const table = tables.item(i)
    setTableColor(table);
}

function setTableColor(table){
    const items = table.getElementsByClassName("item"); 
    for(let i = 0; i < items.length; i++){
        const item = items.item(i)
        const arrow = item.getElementsByClassName("arrow").item(0).getElementsByTagName("i").item(0);
        let pertencageString = item.getElementsByClassName("percentage").item(0).textContent;
        pertencageString = pertencageString.substring(0, pertencageString.length-1);
        let pertencage = parseFloat(pertencageString) / 100;
        pertencage = (pertencage > 1) ? 1 : pertencage;
        pertencage = (pertencage < -1) ? -1 : pertencage;

        if(pertencage>0){
            arrow.style.color = rgbToHex(colourGradientor(pertencage, green, yellow));
            arrow.style.transform = `rotate(${(pertencage*-90)}deg)`;
        }else if (pertencage<0){
            arrow.style.color = rgbToHex(colourGradientor(Math.abs(pertencage), red, yellow));
            arrow.style.transform = `rotate(${(pertencage*-90)}deg)`;
        }else{
            arrow.style.color = rgbToHex(yellow)
        }
    }
}

function rgbToHex(rgb) {
    return "#" + ((1 << 24) + (rgb[0] << 16) + (rgb[1] << 8) + rgb[2]).toString(16).slice(1);
}

function colourGradientor(p, rgb_beginning, rgb_end){
    const w = p * 2 - 1;
    const w1 = (w + 1) / 2.0;
    const w2 = 1 - w1;
    //rgb
    return [parseInt(rgb_beginning[0] * w1 + rgb_end[0] * w2),
        parseInt(rgb_beginning[1] * w1 + rgb_end[1] * w2),
            parseInt(rgb_beginning[2] * w1 + rgb_end[2] * w2)];
}

document.getElementById("descargarImagenes").onclick = downloadImages;

async function downloadImages(){
    const zip = new JSZip();
    for(let i = 0; i < tables.length; i++){
        const table = tables.item(i);
        const tableName = table.getElementsByTagName("caption")[0].getElementsByTagName("span")[0].textContent;
        zip.file(`${i+1}-${tableName}.png`,  await htmlToImage.toBlob(table.parentElement));
    }
    saveAs(await zip.generateAsync({type:"blob"}), "imagenes.zip")
}