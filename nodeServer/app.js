const http = require('http').createServer();
const io = require('socket.io')(http);



io.on('connection', (socket) => {
    console.log('a user connected');

    socket.on('chat-message', (data) => {
        console.log(data)

        io.emit('chat-message', data);
    });
});

http.listen(3000, () => {
    console.log('listening on *:3000');
});
