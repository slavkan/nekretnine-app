const socket = io('http://localhost:3001')
const messageContainer = document.getElementById('razgovorIdDiv')
const messageForm = document.getElementById('send-container')
const messageInput = document.getElementById('newMsgField')
const yourName = document.getElementById('your_name')
const yourId = document.getElementById('your_id')
const chatId = document.getElementById('chat_id')

socket.on('chat-message', data => {
  appendMessage(data.message, data.senderName, 0, data.chat_id);
})

messageForm.addEventListener('submit', e => {
  e.preventDefault();
  const message = messageInput.value
  const senderName = yourName.value
  const chat_id = chatId.value;
  
  var messageObj = []
  messageObj.push(senderName)
  messageObj.push(message)
  messageObj.push(chat_id)
  appendMessage(message, senderName, 1)
  socket.emit('send-chat-message', messageObj)
  messageInput.value = ''
})

function appendMessage(message, senderName, isMsgMine, chat_id) {
  if(chat_id === chatId.value || isMsgMine === 1){
    const currentDate = new Date();
    console.log(currentDate);
    const formattedDate = `${currentDate.getFullYear()}-${(currentDate.getMonth() + 1).toString().padStart(2, '0')}-${currentDate.getDate().toString().padStart(2, '0')}`;
    const formattedTime = `${currentDate.getHours().toString().padStart(2, '0')}:${currentDate.getMinutes().toString().padStart(2, '0')}`;

    const messageElement = document.createElement('div');
    messageElement.classList.add('poruka-container');
    if(isMsgMine == 1){
      messageElement.classList.add('poruka-container-right');
    } else {
      messageElement.classList.add('poruka-container-left');
    }

    const senderNameChildElement = document.createElement('b');
    senderNameChildElement.innerText = senderName;
    messageElement.appendChild(senderNameChildElement);

    const messageContent = document.createElement('div');
    messageContent.classList.add('msg-content');
    messageContent.innerText = message;
    messageElement.appendChild(messageContent);

    const dateTimeRow = document.createElement('div');
    dateTimeRow.classList.add('date-time-row');

    const dateContainer = document.createElement('div');
    dateContainer.classList.add('date-msg-container');
    dateContainer.innerHTML = formattedDate;

    const timeContainer  = document.createElement('div');
    timeContainer.innerText = formattedTime;

    dateTimeRow.appendChild(dateContainer);
    dateTimeRow.appendChild(timeContainer);

    messageElement.appendChild(dateTimeRow);

    messageContainer.prepend(messageElement)
  }
}