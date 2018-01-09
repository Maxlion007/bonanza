<div class="container">

        <?php foreach($model->_conditions->conditions as $key=>$condition){
            if($condition->type=='boolean')
            {
                ?>
                <div class="col-sm-6">
                    <div class="check">
                        <?php //echo $form->field($model->_conditions->conditions,$condition->slug)->checkbox();?>
                        <input type="checkbox" id="<?php echo $condition->slug;?>" name="_conditions[<?php echo $key?>]" <?php if(isset($model->_conditions[$key]) && $model->_conditions[$key]!=null){echo ' selected';}?>> <label for="<?php echo $condition->slug;?>"><?php echo $condition->name;?></label>
                    </div>
                </div>
                <?php
            }else
            {
                if(count($condition->variants)>1 ) {
                    ?>
                    <div class="col-sm-6">
                        <label><?php echo $condition->name;?></label>
                        <?php // echo $form->field($model->_conditions,$condition->slug)->dropDownList($condition->variants)?>
                        <select
                            <?php if ($condition->type == 'multiple'){echo ' name="_conditions['.$key.'][]" multiple';}else{echo "name=\"_conditions[".$key."]\"";}?>
                        >
                            <?php

                            foreach($condition->variants as $variant){
                                ?>
                                <option value='<?php echo $variant?>'

                                    <?php
                                    if($_POST && isset($model->_conditions[$key]))
                                    {
                                        if(is_array($model->_conditions[$key]) && in_array($variant,$model->_conditions[$key])
                                        )
                                        {
                                            echo ' selected';
                                        }elseif((is_string($model->_conditions[$key]) && $variant==$model->_conditions[$key])
                                        )
                                        {
                                            echo ' selected';
                                        }
                                    }?> >
                                    <?php echo $variant?> </option>";
                            <?php } ?>
                        </select>
                    </div>
                    <?php
                }
                else
                {
                    ?>
                    <?php //echo $form->field($model->_conditions,$condition->slug)->textInput();?>
                    <div class="col-sm-6"><label><?php echo $condition->name;?></label> <input type="text" name="_conditions[<?php echo $key?>]" <?php if(isset($_POST['SearchModelForm'][$key]) && isset($model->_conditions[$key]) && $model->_conditions[$key]!=null){echo ' value="'.$model->_conditions[$key].'"';}?>>
                    </div>
                    <?php
                }

                ?>
            <?php }
        } ?>
</div>