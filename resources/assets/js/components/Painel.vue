<template>
    <div v-bind:class="defineCor">
        <div v-if="titulo" class="panel-heading">{{titulo}}</div>
        <div class="panel-body">
            <slot></slot>
        </div>
    </div>   
</template>

<script>
    export default {
      props:['titulo', 'cor'],
      computed:{
          defineCor: function(){
              return "panel "+ (this.cor || "panel-default");
          }
      }
    }
</script>

<style media="screen">
.blue  {
   
    border-color: #005280;
}
.blue > .panel-heading {
    color: #FFF;
    background-color: #005280;
    border-color: #005280;
}

.orange  {
   
    border-color: #f0661f;
}
.orange > .panel-heading {
    color: #FFF;
    background-color: #f0661f;
    border-color: #f0661f;
}
</style>

