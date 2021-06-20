<script>
     function play(path, views) {
          path = path.toString()
          var video = document.getElementById('vidshow');

          document.getElementById('viddiv').style.display = "block";
          var source = document.getElementById('srcvid');
          source.setAttribute('src', path);
          video.load();

          var temp = path.replace('../Teacher/videos/', '');
          

     }
</script>