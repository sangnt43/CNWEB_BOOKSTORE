// const https = require('https');
// const fs = require('fs');

// https.get("https://www.fahasa.com/fahasa_catalog/product/loadproducts?category_id=4&currentPage=1&limit=2000&order=created_at", (res) => {
//     let data = '';

//     // A chunk of data has been recieved.
//     res.on('data', (chunk) => {
//         data += chunk;
//     });

//     // The whole response has been received. Print out the result.
//     res.on('end', () => {
//         fs.writeFile("data.json", JSON.stringify(JSON.parse(data).product_list), err => {
//             if (err) console.log(err);
//             console.log("saved!")
//         })

//     });
// })

var https = require('https'),
    Stream = require('stream').Transform,
    fs = require('fs'),
    path = require('path'),
    crypto = require('crypto'),
    os = require('os');

const image_path = path.join(__dirname, "../../", "public", "images");
const query = "INSERT INTO `books`(`Id`, `Name`, `Description`, `Info_Auth`, `Info_PublisherId`, `BookCategoryId`, `Avatar`, `Images`, `Seo`, `Discount`, `Price`) values ";

function objectId() {
    const secondInHex = Math.floor(new Date() / 1000).toString(16);
    const machineId = crypto.createHash('md5').update(os.hostname()).digest('hex').slice(0, 6);
    const processId = process.pid.toString(16).slice(0, 4).padStart(4, '0');
    const counter = process.hrtime()[1].toString(16).slice(0, 6).padStart(6, '0');
    return secondInHex + machineId + processId + counter;
}

function createSeo(data) {
    return data.toLowerCase().trim().replace(/[áàảãạăắằẳẵặâấầẩẫậ]/g, 'a').replace(/[óòỏõọôốồổỗộơớờởỡợ]/g, 'o').replace(/[éèẻẽẹêếềểễệ]/g, 'e').replace(/[íìỉĩị]/g, 'i').replace(/[úùủũụưứừửữự]/g, 'u').replace(/[ýỳỷỹỵ]/g, 'y').replace(/[đ]/g, 'd').replace(/[^a-z0-9- ]/g, '').replace(/[ ]/g, '-').replace(/[--]+/g, '-')
}

function getPrice(price) {
    price = price.split('.');
    price.pop();
    return Math.ceil(price.join('') / 23);
}

async function fetchData() {
    return JSON.parse(await fs.readFileSync("data.json"));
}

async function insertQuery(book, query) {
    let id = objectId();
    let fileName = "images/" + await saveImage(book['image_src'], id);
    let _query = `('${id}','${book['product_name']}','${book['product_name']}',null,null,'5eeee438303463065841bdd5','${fileName}','${fileName}','${createSeo(book['product_name'])}',0,${getPrice(book['product_price'])}), `;
    return query + _query;
}

function saveImage(url, id) {
    return new Promise((res, rej) => {
        let ext = path.extname(url);
        https.request(url, function(response) {
            var data = new Stream();

            response.on('data', function(chunk) {
                data.push(chunk);
            });

            response.on('end', async function() {
                let fileName = `${id}${ext}`;
                await fs.writeFileSync(`${image_path}/${fileName}`, data.read());
                res(fileName);
            });
        }).end();
    })
}

async function Do(query) {
    let data = await fetchData();

    for (let book of data)
        query = await insertQuery(book, query);

    if (query[query.length - 1] == ',') query = query.split(0, -1);

    await fs.writeFileSync("query.sql", query.toString(), res => {
        console.log(res);
    });
};

Do(query);

// const images =

// console.log(path.join(__dirname, "../../", ))

// var url = 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/b/t/btthta9-tap2-kda_homepage.jpg';

// https.request(url, function(response) {
//     var data = new Stream();

//     response.on('data', function(chunk) {
//         data.push(chunk);
//     });

//     response.on('end', function() {
//         fs.writeFileSync('image.png', data.read());
//     });
// }).end();