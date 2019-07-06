var restify = require('restify');

const {registerBlockchain} = require('./sawtooth/client');
const processor = require('./sawtooth/processor');
const {VoteHandler} = require('./sawtooth/voteHandler');
const request = require('request');
const {searchBlockchain} = require('./sawtooth/infra');
const {getAddress, handlerInfo} = require('./sawtooth/infra');
const secp256k1 = require('secp256k1')
const {Secp256k1PrivateKey} = require('sawtooth-sdk/signing/secp256k1')
const {createContext, CryptoFactory} = require('sawtooth-sdk/signing');
const crypto = require('crypto');

processor(new VoteHandler());

function registerVote(req, res, next) {
    const voto = req.body;

    const pkAsBytes = Secp256k1PrivateKey.fromHex(voto.userNumber)

    voto.publicKey = secp256k1.publicKeyCreate(pkAsBytes.privateKeyBytes).toString('hex');

    console.log(voto);
    //res.send(voto);
    //next();

    registerBlockchain(voto);
    //console.log("OK")
    res.send(200);
    next();
}   

function search(req, res, next) {
    const address = req.params.address;

    searchBlockchain(address, (votes) => {
        res.send(votes);
            res.send
        next();
    });
  }

var server = restify.createServer();
server.use(restify.plugins.acceptParser(server.acceptable));
server.use(restify.plugins.bodyParser());

server.post('/register/vote', registerVote);
server.get('/search/:address', search);

server.post('/election-url', function(req, res, next){
    const electionName = req.body.electionName;

    const info = handlerInfo();
    const familyName = getAddress(info.family, 6);
    const crip = getAddress(electionName, 20);
    const aux = {};
    aux.url = "http://localhost:8084/search/" + familyName + crip;
    aux.electionCode = crip;
    aux.familyCode = familyName;
    res.send(aux);
    next();
});

server.post('/familyCode', function(req, res, next){
    const info = handlerInfo();
    const familyName = getAddress(info.family, 6);
    res.send({"familyName" : familyName});
    next();
});


server.get("/get-public-key/:privateKey", function(req, res, next){
    const privateKey = req.params.privateKey;

    const pkAsBytes = Buffer.from(privateKey, "hex");

    
    //verificar privateKeyVerify
    if(secp256k1.privateKeyVerify(pkAsBytes)){
        const aux = {};
        aux.publicKey = secp256k1.publicKeyCreate(pkAsBytes).toString('hex');

        res.send(aux);
    }
    else{
        const error = {};
        error.code = "Invalid private key"
        res.send(error);
    }

    
});


//Isso deve ser gerado de outra maneira no futuro!
//o verificar é o id do usuario +  encriptado em sha512!
server.post("/generate-private-key", function(req, res, next){
    const cript = req.body.cript;
    const cpf = req.body.cpf;
    const matricula = req.body.matricula;

    const VERIFICADOR = "uffs_2019";

    //Loading the crypto module in node.js
    
    //criar o objeto
    const hash = crypto.createHash('sha512');
    //a data e o formado da data que sera encriptado
    const data = hash.update(cpf + matricula + VERIFICADOR);
    //transformar em hexa
    const verificador = data.digest('hex');
    
    if(verificador !== cript.toLowerCase()){
        res.send(401);
    }
    else{
        const context = createContext('secp256k1');
        const privateKey = context.newRandomPrivateKey().privateKeyBytes.toString('hex');
        const aux = {};
        aux.privateKey = privateKey;
        res.send(aux);
    }
});


server.get("/gp", function(req, res, next){
    
    const context = createContext('secp256k1');
    const privateKey = context.newRandomPrivateKey().privateKeyBytes.toString('hex');
    res.send(privateKey);
});

server.listen(8084, function() {
    console.log('%s listening at %s', server.name, server.url);
});
