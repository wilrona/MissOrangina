<div class="page-header">
    <div class="l-container">
        <h1>Parrainage</h1>

    </div>
</div>
<div class="l-container l-container-page">
    <h2 style="text-align: center;margin-bottom: 20px;border-bottom: 1px solid #e3e3e3;">Maximise tes changes de gagner, <br/> fais toi soutenir par  <span class="link" >Cinq (5) amis</span></h2>
    <div class="alert alert-danger hidden">
        <h3>Certaines informations n'ont pas ete renseignees</h3>
    </div>
    <form class="form-horizontal" action="<?php echo get_site_url()."/inscription/parrain"; ?>" method="post">
            <div class="form-group">
                <label class="label-form control-label" style="text-align: left !important; font-size: 20px !important;"> Ami(e) #1 :
                    <hr/></label>
                <div class="input-form">
                    <input type="email" class="form-control" name="parrain[]" placeholder="Adresse Email" value="" id="1" required="required" <?php if(!empty($this->email)): ?> value="<?php echo $this->email[0];?>" <?php endif; ?>>
                </div>
            </div>
            <div class="form-group">
                <label class="label-form control-label" style="text-align: left !important; font-size: 20px !important;"> Ami(e) #2 :
                    <hr/></label>
                <div class="input-form">
                    <input type="email" class="form-control" name="parrain[]" placeholder="Adresse Email" value="" id="2" required="required" <?php if(!empty($this->email)): ?> value="<?php echo $this->email[1];?>" <?php endif; ?>>
                </div>
            </div>
            <div class="form-group">
                <label class="label-form control-label" style="text-align: left !important; font-size: 20px !important;"> Ami(e) #3 :
                    <hr/></label>
                <div class="input-form">
                    <input type="email" class="form-control" name="parrain[]" placeholder="Adresse Email" value="" id="3" required="required" <?php if(!empty($this->email)): ?> value="<?php echo $this->email[2];?>" <?php endif; ?>>
                </div>
            </div>
            <div class="form-group">
                <label class="label-form control-label" style="text-align: left !important; font-size: 20px !important;"> Ami(e) #4 :
                    <hr/></label>
                <div class="input-form">
                    <input type="email" class="form-control" name="parrain[]" placeholder="Adresse Email" value="" id="4" required="required" <?php if(!empty($this->email)): ?> value="<?php echo $this->email[3];?>" <?php endif; ?>>
                </div>
            </div>
            <div class="form-group">
                <label class="label-form control-label" style="text-align: left !important; font-size: 20px !important;"> Ami(e) #5 :
                    <hr/></label>
                <div class="input-form">
                    <input type="email" class="form-control" name="parrain[]" placeholder="Adresse Email" value="" id="5" required="required" <?php if(!empty($this->email)): ?> value="<?php echo $this->email[4];?>" <?php endif; ?>>
                </div>
            </div>
            <div class="form-group">
                <div class="input-form input-button">
                    <?php wp_nonce_field("parrain", "nonce"); ?>
                    <input type="hidden" name="idfacebook" value="<?php echo $this->id; ?>"/>
                    <button type="submit" class="btn btn-contact btn-form" id="submit">Terminer votre inscription</button>
                </div>
            </div>


    </form>
</div>