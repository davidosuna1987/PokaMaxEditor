<template>
  <section id="signature_pad">
    <div class="modal-card" style="width: 500px">
       <section class="modal-card-body">
        <VueSignaturePad width="400px" :options="{penColor: '#041a98'}" height="300px" ref="signaturePad"></VueSignaturePad>
      </section>
      <footer class="modal-card-foot signature-pad-footer">
        <div class="action-buttons">
          <button class="button is-link" @click="save()">Save signature</button>
          <button class="button is-info" @click="undo()">Undo step</button>
        </div>
        <button class="button" @click="$parent.close()">Cancel</button>
      </footer>
    </div>
  </section>
</template>

<script>
  export default {
    methods: {
      undo() {
        this.$refs.signaturePad.undoSignature();
      },
      save() {
        const { isEmpty, data } = this.$refs.signaturePad.saveSignature();
        // console.log(isEmpty, data);
        this.$emit('signature-created', isEmpty ? null : data);
        this.$parent.close();
      }
    }
  }
</script>
