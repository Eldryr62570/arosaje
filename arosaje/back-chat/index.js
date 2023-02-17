const express = require('express');
const app = express();
const http = require("http");
const { Server } = require('socket.io')
const cors = require("cors")


app.use(cors());
const server = http.createServer(app)
const io = new Server(server, {
    cors: {
      origin: "http://localhost:3000",
      methods: ["GET", "POST"],
      credentials: true
    }
});
    
io.on("connection" , (socket)=>{
    socket.on("send_message"  , ({idUser,idRoom,message,time}) =>{
        socket.to(idRoom).emit("receive_message" ,{idUser,idRoom,message,time})
    })
    socket.on("join_room" , ({idUser, idRoom}) => {
      socket.join(idRoom)
    })

})
server.listen(3001, () => {
    console.log("SERVER IS RUNNING");
})