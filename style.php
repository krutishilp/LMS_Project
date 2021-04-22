   <style type="text/css">
body
{
  background-color: #121212;
  font-family: 'Poppins', sans-serif;
  font-size: 20px;
   -webkit-user-select: none;  /* Chrome all / Safari all */
  -moz-user-select: none;     /* Firefox all */
  -ms-user-select: none;      /* IE 10+ */
  user-select: none;          /* Likely future */    
}
.pad2
{
  padding:30px;
}
.abtpad
{
 padding-top:20px; 
 padding-bottom:50px; 
}
.adminpad
{
 padding-bottom:30px;  
}
#sb
{
  background-color: #ffffff;
  float: left;
  padding: 20px;
  width: 350px;
  height: 100vh;
  display: none;
  position: relative;
}
#sb li
{
	cursor: pointer;
 
}
.sub
{
 display: none;
}
#viddiv
{
	display: none;
}
.pad
{
	padding: 10px;
}
.fc
{
  padding: 20px;
  background-color: #f5f5f5;
  border-radius: 5px;
  border:2px solid #f5f5f5;
  box-shadow: 5px 5px 10px #d5d5d5;
  font-size:19px; 
}
.fc input,select
{
  border:none;
  border-bottom: 1px solid #121212;
  background-color:#f5f5f5;
  padding: 8px;
  width:75%;
  display: inline-block;
}
.fc input:focus,select:focus
{
  outline:none;
  border:none;
  border-bottom:2px solid #5bc0de;
  background-color:#f5f5f5;
}
.fc input[type=submit]
{
  background-color:#5bc0de ;
  border:1px solid #5bc0de ;
  color: black ;
  padding: 10px;
  border-radius: 5px;
  width: 150px;
}
.fc button
{
  background-color:#5bc0de  ;
  border:1px solid #5bc0de ;
  color: black ;
  padding: 10px;
  border-radius: 5px;
  width: 150px;
}
.fc button:disabled
{
  background-color:#d5d5d5  ;
  border:1px solid #d5d5d5 ;
  color: black ;
}
.fc input[type=file]
{
  background-color:#f5f5f5  ;
  border:1px solid #121212 ;
  color: black ;
  padding: 10px;
  border-radius: 5px;
}

.fc input[type=file]:focus
{
  border:1px solid #5bc0de ;
}

#subdiv
{
  display: none;
}
#footer
{
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100vw;
  color: white;
}
.tbform
{
  background: transparent;
  color: black;
}
.tbform input
{
 background: transparent;color: black ; border: none;
}


.qdiv
{
  padding: 30px;
    background-color: #f5f5f5;
    border-radius: 10px;
    font-size: 20px;
    width: 100%;
    position: center;
    overflow: auto;
}

.qdiv input[type='radio']:after {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        top: -8px;
        left: -2px;
        position: relative;
        background-color: #d1d3d1;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }

.qdiv input[type='radio']:checked:after {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        top: -8px;
        left: -2px;
        position: relative;
        background-color: #5bc0de;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid #5bc0de;
    }

.qdiv input[type='radio']:checked + label {
        
        color: #5bc0de;
    }

.qdiv input[type='radio']:hover + label {
        
      cursor: pointer;
    }
.qdiv a
{
  text-decoration: none;
  background-color: #f5f5f5;
  padding-left:10px;
  padding-right: 10px;
  border:1px solid #5bc0de;
  border-radius:5px;
  color: #5bc0de;
  font-weight: bolder;
  font-size:25px;
}
.qdiv a:hover
{
  background-color: #5bc0de;
  border:1px solid #5bc0de;
  border-radius:5px;
  color: black;
}

.qdiv a:visited
{
  background-color: #5bc0de;
  border:1px solid #5bc0de;
  border-radius:5px;
  color: #e3f2fd;
}
.qdiv input[type='submit']
{
 background-color: #f5f5f5;
  padding-left:10px;
  padding-right: 10px;
  border:1px solid #5bc0de;
  border-radius:5px;
  color: #5bc0de; 
  font-size: 20px;
  font-weight: bolder;
}
.qdiv input[type='submit']:hover
{
  background-color: #5bc0de;
  border:1px solid #5bc0de;
  border-radius:5px;
  color: black; 
}
.qdiv button
{
  background-color: transparent;
  color: #5bc0de;
  border: 2px solid #5bc0de;
  border-radius: 45%;
  font-size: 25px;
  font-weight: bolder;
}
.qdiv button:focus
{
 outline: none;
}
.qdiv button:hover
{
  background-color: #5bc0de;
  color: black;
  border: 2px solid #5bc0de;
}
/* Chrome, Safari and Opera syntax */
:-webkit-full-screen {
  background-color: #d5d5d5;
}

/* Firefox syntax */
:-moz-full-screen {
  background-color:#d5d5d5;
}

/* IE/Edge syntax */
:-ms-fullscreen {
  background-color:#d5d5d5;
}

/* Standard syntax */
:fullscreen {
  background-color:white;
}

  ::-webkit-scrollbar{
  width: 7px;
  display: none;
}
 ::-webkit-scrollbar:hover{
  display: block;
}

/* Track */
::-webkit-scrollbar-track{
  background: #333;

  border: 1px solid #333;
}
 
/* Handle */
::-webkit-scrollbar-thumb{
  background: #5bc0de;

  border: 1px solid #5bc0de;
}


a.selected {
  background-color:#1F75CC;
  color:white;
  z-index:100;
}

.messagepop {
  background-color: #f5f5f5;
  border:1px solid #999999;
  border-radius: 3px;
  cursor:default;
  display:none;
  margin-top: 15px;
  position:absolute;
  text-align:left;
  width:700px;
  z-index:50;
  padding: 25px 25px 20px;
}

label {
  display: block;
  margin-bottom: 3px;
  padding-left: 15px;
  text-indent: -15px;
}

.messagepop p, .messagepop.div {
  border-bottom: 1px solid #EFEFEF;
  margin: 8px 0;
  padding-bottom: 8px;
}



    </style>