import html2canvas from 'html2canvas';
import { saveAs } from 'file-saver';
import * as htmlToImage from 'html-to-image';
import { toPng, toJpeg, toBlob, toPixelData, toSvg } from 'html-to-image';
import * as JSZip from 'jszip';

const tables = document.getElementsByTagName("table");

for(let i = 0; i < tables.length; i++){
    const table = tables.item(i)
    setTableColor(table);
}

function setTableColor(table){
    var items = table.getElementsByClassName("item"); 
    for(let i = 0; i < items.length; i++){
        const item = items.item(i)
        var arrow = item.getElementsByClassName("arrow").item(0).getElementsByTagName("i").item(0);
        var pertencageString = item.getElementsByClassName("percentage").item(0).textContent;
        pertencageString = pertencageString.substring(0, pertencageString.length-1);
        var pertencage = parseFloat(pertencageString)/100;
        pertencage = (pertencage>1)? 1 : pertencage;
        if(pertencage < -1){
            console.log(item);
        }
        pertencage = (pertencage < -1)?-1:pertencage;

        if(pertencage>0){
            arrow.style.color = rgbToHex(colourGradientor(pertencage, [39, 130, 3], [240, 250, 60]));
            arrow.style.transform = "rotate("+(pertencage*-90)+"deg)";
        }else if (pertencage<0){
            arrow.style.color = rgbToHex(colourGradientor(Math.abs(pertencage), [212, 28, 4], [240, 250, 60]));
            arrow.style.transform = "rotate("+(pertencage*-90)+"deg)";
        }else{
            arrow.style.color = rgbToHex([225, 235, 38])
        }
    }
}

function rgbToHex(rgb) {
    return "#" + ((1 << 24) + (rgb[0] << 16) + (rgb[1] << 8) + rgb[2]).toString(16).slice(1);
}

function colourGradientor(p, rgb_beginning, rgb_end){

    var w = p * 2 - 1;


    var w1 = (w + 1) / 2.0;
    var w2 = 1 - w1;

    var rgb = [parseInt(rgb_beginning[0] * w1 + rgb_end[0] * w2),
        parseInt(rgb_beginning[1] * w1 + rgb_end[1] * w2),
            parseInt(rgb_beginning[2] * w1 + rgb_end[2] * w2)];
    return rgb;
};

document.getElementById("descargarImagenes").onclick = downloadImages;

async function downloadImages(){
    var zip = new JSZip();
    for(let i = 0; i < tables.length; i++){
        const table = tables.item(i);
        zip.file('image'+i+'.png',  await htmlToImage.toBlob(table.parentElement));
    }
    
    saveAs(await zip.generateAsync({type:"blob"}), "imagenes.zip")
}