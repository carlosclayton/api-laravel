var dateFormat = require('dateformat');

const SimpleNodeLogger = require('simple-node-logger'),
    opts = {
        logFilePath: __dirname + '/socket-server.log',
        timestampFormat: 'YYYY-MM-DD HH:mm:ss.SSS'
    },
    log = SimpleNodeLogger.createSimpleLogger(opts);


log.info("=> Iniciando debug...");


let dt = Date.now()

var net = require('net');
var fs = require('fs');
var bodyParser = require('body-parser');
var cors = require('cors');
var logger = require('morgan');
var errorhandler = require('errorhandler');
var axios = require('axios');

var express = require('express')
var app = express();


app.use(bodyParser.urlencoded({extended: true}));
app.use(bodyParser.json());
app.use(cors({origin: true, credentials: true}));

if (process.env.NODE_ENV === 'development') {
    app.use(logger('dev'));
    app.use(errorhandler());
}

var port = process.env.PORT || 3001;

var load = require('express-load');
var server = require('http').createServer(app);
var io = require('socket.io').listen(server);

let messages = [];
io.sockets.on('connection', function (socket) {

    log.info('=> Socket Cliente conectado com ID: ', socket.id);

    socket.on('giroInput', function (data) {

        console.log('Dados: ', data);
        // Enviando GIRO de ENTRADA OU SAIDA
        let tipo = (data.type == 5) ? 'ENTRADA' : 'SAIDA'
        let message = "00+REON+000+" + data.type + "]10]1651453374]" + tipo + " LIBERADA]";
        // client.write(hex2str("02" + resultado(entrada) + toHex(entrada) + checksum(entrada) + "03"))

        //let codigo = '01+RD+00+D]' + data.id
        //let codigo = '01+ECAR+00+1+A[1[29[[[1[1[1[[[[[[[[[[[Carlos Clayton'

        //let codigo = '01+RD+00+D]29'


        //client.write(hex2str("02" + resultado(codigo) + toHex(codigo) + checksum(codigo) + "03"))
        console.log('Message: ', message);
        axios.post('http://localhost:8000/api/biometries/catraca', {
            message: message
        })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });

        let msg = 'Iniciando a coleta biométrica...'
        socket.emit('giroOutput', {
            message: msg
        });
    });


    //if(io.nsps['/'].adapter.rooms["room-"+roomno] && io.nsps['/'].adapter.rooms["room-"+roomno].length > 1) roomno++;
    //socket.join("room-"+roomno);

    //let room = 10
    //socket.join(room);
    //console.log('Total room:', io.sockets.adapter.rooms[room].length);

    socket.on('join-room', function (data) {
        console.log('Join Room: ', data.number);

        socket.join(data.number);
        console.log('Total room:', io.sockets.adapter.rooms[data.number].length);

        //io.sockets.in('room10').emit('previousMsg', 'Equipamento aguardando giro de do usuário');
    });

    //io.sockets.in("room-"+roomno).emit('previousMsg', 'what is going on, party people?');

    socket.on('sendServer', function (data) {
        console.log('Received Data: ', data);

        socket.emit('previousMsg', {
            message: 'Equipamento aguardando giro de do usuário',
            user: data.id
        });

        //socket.join(10);
        /*
        socket.emit('previousMsg', {
                    message: 'Equipamento aguardando giro de do usuário',
                    user: data.id
                });
        socket.broadcast.emit('previousMsg', {
                    message: 'Equipamento aguardando giro de do usuário',
                    user: data.id
                });
        */
        //io.sockets.in("room-"+roomno).emit('connectToRoom', "You are in room no. "+roomno);
        console.log('Room:', data)
        io.to(data.para).emit('previousMsg', {
            de: data.de,
            para: data.para
        });
    });

    socket.on('sendCatraca', function (data) {
        console.log('Received Data: ', data);

        socket.emit('catracaMsg', {
            message: 'Equipamento aguardando giro de do usuário',
            user: data.id,
            type: 'warning'
        });

        //socket.join(10);
        /*

        socket.broadcast.emit('previousMsg', {
                    message: 'Equipamento aguardando giro de do usuário',
                    user: data.id
                });
        */
        //io.sockets.in("room-"+roomno).emit('connectToRoom', "You are in room no. "+roomno);
        console.log('Room:', data);

        io.to(data.para).emit('previousMsg', {
            de: data.de,
            para: data.para
        });
    });


// Servidor Henry test
    var HOST = '10.155.152.113';
    var PORT = 3000;

    var client = new net.Socket();

    client.connect(PORT, HOST, function () {
        log.info('=> Cliente Henry conectado ao HOST ' + HOST + ':' + PORT);
        client.setEncoding('utf-8');

    });

    client.on('data', function (data) {
        log.info('=> Evento recebido ', data);

        socket.emit('giroOutput', {
            message:  data
        });

        ret1 = data.split("]")
        ret2 = ret1[0].split('+')
        //
        // console.log('ARRAY 1: ', ret1);
        // console.log('ARRAY 2: ', ret2);
        //
        // if(ret2[1] == 'ECAR'){
        //
        //     socket.emit('giroOutput', {
        //         message: 'Cartão cadsastrado com sucesso'
        //     });
        //
        //     let codigo = '01+CB+00+29'
        //     client.write(hex2str("02" + resultado(codigo) + toHex(codigo) + checksum(codigo) + "03"))
        //
        //     socket.emit('giroOutput', {
        //         message: 'Iniciando coleta biométrica...'
        //     });
        //
        // }else if(ret2[1] == 'REON') {
        //     socket.emit('giroOutput', {
        //         message: 'Biometria cadastrada com sucesso'
        //     });
        //
        //     let codigo = '01+RD+00+D]29'
        //     client.write(hex2str("02" + resultado(codigo) + toHex(codigo) + checksum(codigo) + "03"))
        //
        //     socket.emit('giroOutput', {
        //         message: 'Sincronizando equipamentos...'
        //     });
        // }


        if(ret2[3] == 81){
            socket.emit('giroOutput', {
                message: 'Giro realizado com sucesso',
                type: 'success'
            });

        }else if(ret2[3] == 82){
            socket.emit('giroOutput', {
                message: 'Giro não realizado',
                type: 'error'
            });
        }
    });

    // Add a 'close' event handler for the client socket
    client.on('close', function () {
        console.log('Client closed');
        pool.end()
    });


});

server.listen(port, function () {
    log.info('=> Servidor Socket rodando no HOST: localhost:' + port);
});