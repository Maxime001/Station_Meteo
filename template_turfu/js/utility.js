function shuffleArray(array) {
    for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
    return array;
}

// Random between min and max
function randomInt(min, max) {
    return Math.floor((Math.random() * (max - min + 1)) + min);
}

// Generates random status for testing
function generateRandomStatusData(data) {
    for (var sensor_name in data) {
        data[sensor_name] = randomInt(0, 1);
    }
    
    return data;
}