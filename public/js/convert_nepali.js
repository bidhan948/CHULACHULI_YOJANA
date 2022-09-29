function convertToWords(number) {
    var str = number.toString();
    var length = str.length;
    var nepaliStr = [];
    if (length > 3) {

        // get last three digits of given number
        var lastThree = str.lastThree();

        // remove last three digit and take remaining digits
        var remStr = str.removeLastThree();

        // get length of remaining digits in number
        var remStrLength = remStr.length;


        // make a array
        var remStrips = lastThree.sliceToTwo().concat(remStr.sliceToTwo());

        console.log(remStrips)
        //reverse the array and join
        nepaliStr = remStrips.reverseAndJoin();
    }
    else {

        remStrips = str.sliceToTwo();
        nepaliStr = remStrips.reverseAndJoin();
    }

    return nepaliStr;

}

function convertToNepaliDigit(number) {
    if(!number) return '';
    var number = number.toString();
    var sliced = [];
    var numberLength = number.length
    var nepali_digits = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];
    for (i = 0; i < numberLength; i++) {
        sliced.push(nepali_digits[number.substr(number.length - 1)]);
        number = number.slice(0, -1);
    }
    return sliced.reverse().join('').toString();
}
function convertToEnglishDigit(number) {
    if(!number) return '';
    var number = number.toString();
    var sliced = [];
    var numberLength = number.length
    var nepali_digits = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];
    for (i = 0; i < numberLength; i++) {
        var last_digit = number.substr(number.length - 1);
        var index = nepali_digits.indexOf(last_digit);
        if(index > -1) sliced.push(index);
        if(last_digit >= 0 && last_digit <= 9 && index <= -1) sliced.push(last_digit);
        number = number.slice(0, -1);
    }
    return sliced.reverse().join('').toString();
}

function convertToNepaliRate(number) {
    var num = number.toString();
    switch (number) {
        case '100':
            $type = " (प्रतिसत)";
            break;
        case '1000':
            $type = " (प्रति हजार)";
            break;
        case '100000':
            $type = " (प्रति लाख)";
            break;
        case '10000000':
            $type = " (प्रति करोड)";
            break;
        default:
            $type = " (रु)";
            break;
    }
    return $type;

}

function convertToNepaliText(number) {
    var number = number.toString();
    var number_before_decimal = number.split(".")[0]
    var number_after_decimal = number.split(".")[1]
    var text1 = convertToWords(number_before_decimal);
    var text2 = "";
    if (typeof number_after_decimal !== "undefined") {
        text2 = convertToWords(number_after_decimal);
        return text1 + " दशमलव " + text2;
    }
    else {
        return text1;
    }

}

function convertToNepaliNumber(number) {
    var number = number.toString();
    var number_before_decimal = number.split(".")[0]
    var number_after_decimal = number.split(".")[1]
    var text1 = convertToNepaliDigit(number_before_decimal);
    var text2 = "";
    if (typeof number_after_decimal !== "undefined") {
        text2 = convertToNepaliDigit(number_after_decimal);
        return text1 + "." + text2;
    }
    else {
        return text1;
    }

}
function convertToEnglishNumber(number) {
    var number = number.toString();
    var number_before_decimal = number.split(".")[0]
    var number_after_decimal = number.split(".")[1]
    var text1 = convertToEnglishDigit(number_before_decimal);
    var text2 = "";
    if (typeof number_after_decimal !== "undefined") {
        text2 = convertToEnglishDigit(number_after_decimal);
        return text1 + "." + text2;
    }
    else {
        return text1;
    }

}

function convertToNepaliString(number, character) {
    if(!number) return '';
    var number = number.toString();
    var splitted_number = number.split(character);
    var item = '';
    for (let index = 0; index < splitted_number.length; index++) {
        const element = splitted_number[index];
        item +=  convertToNepaliDigit(element);
        if(index != splitted_number.length -1) item += character;
    }

    return item;
}


function convertToCommaNumber(number) {
    var number = number.toString();
    var number_before_decimal = number.split(".")[0]
    var number_after_decimal = number.split(".")[1]
    var text1 = commafy(number_before_decimal);
    var text2 = "";
    if (typeof number_after_decimal !== "undefined") {
        text2 = number_after_decimal;
        return text1 + "." + text2;
    }
    else {
        return text1;
    }

}

function commafy(number) {

    var str = number.toString();
    var length = str.length;
    if (length > 3) {

        // get last three digits of given number
        var lastThree = str.lastThree();

        // remove last three digit and take remaining digits
        var number = str.slice(0, -3);
        var sliced = [];
        var numberLength = number.length
        for (i = 0; 1 <= number.length; i++) {
            sliced.push(number.substr(number.length - 2));
            number = number.slice(0, -2);
        }

        // make a array
        var remStrips = sliced.reverse().join(",") + "," + lastThree;
        return remStrips;
    }
    else {

        return str;
    }

}
