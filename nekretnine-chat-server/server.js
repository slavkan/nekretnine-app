const io = require('socket.io')({
  cors: {
    origin: '*',
    methods: ['GET', 'POST'],
  },
});

const users = {};

io.on('connection', socket => {
  socket.on('send-chat-message', message => {
    socket.broadcast.emit('chat-message', { message: message[1], name: users[socket.id], senderName: message[0], chat_id: message[2]  });
  });

  socket.on('disconnect', () => {
    socket.broadcast.emit('user-disconnected', users[socket.id]);
    delete users[socket.id];
  });
});

io.listen(3001);