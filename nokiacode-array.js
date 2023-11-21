let nokiacode = [
    " ",
    '',
    ["a","b","c"],
    ["d","e","f"],
    ["g","h","i"],
    ["j","k","l"],
    ["m","n","o"],
    ["p","q","r","s"],
    ["t","u","v"],
    ["w","x","y","z"],
    ["+"],
    ["#"]
]

let text = '99966688027773306665553';

function nokiakeysToText(str) {
    let arr = str.split('');
    let result = [];
    let count = 0;
    arr.forEach((item,i) => {
        if(item === arr[i+1]) {
            count++;
        } else {
            result.push(nokiacode[item][count]);
            count = 0;
        }
    })
    return result.join('');

}

const textToNokiakeys = (text) => {
    return text.split('').map(char => {
        let key = nokiacode.findIndex(e => e.includes(char)) + '';
        let amount = typeof nokiacode[key] === 'object' ? 
                    nokiacode[key].findIndex(e => e === char) : 
                    0;
        return key.repeat(amount + 1);
    }).join('');
};


console.log(textToNokiakeys('maximum effort for a text'));
console.log(nokiakeysToText('99966688027773306665553'));
console.log(nokiakeysToText('6299444688603333333366677780333666777020833998'));

