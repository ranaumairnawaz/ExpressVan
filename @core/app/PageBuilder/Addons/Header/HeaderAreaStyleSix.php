<?php


namespace App\PageBuilder\Addons\Header;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\PageBuilderBase;

class HeaderAreaStyleSix extends PageBuilderBase
{

    /**
     * @inheritDoc
     */
    public function preview_image()
    {
       return 'header-area-style-06.png';
    }

    /**
     * @inheritDoc
     */
    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();


        $output .= $this->admin_language_tab(); //have to start language tab from here on
        $output .= $this->admin_language_tab_start();

        $all_languages = LanguageHelper::all_languages();
        foreach ($all_languages as $key => $lang) {
            $output .= $this->admin_language_tab_content_start([
                'class' => $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade',
                'id' => "nav-home-" . $lang->slug
            ]);

            $output .= Text::get([
                'name' => 'title_' . $lang->slug,
                'label' => __('Title'),
                'value' => $widget_saved_values['title_' . $lang->slug] ?? null,
            ]);
            $output .= Textarea::get([
                'name' => 'description_' . $lang->slug,
                'label' => __('Description'),
                'value' => $widget_saved_values['description_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'button_text_' . $lang->slug,
                'label' => __('Button Text'),
                'value' => $widget_saved_values['button_text_' . $lang->slug] ?? null,
            ]);

            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

        $output .= IconPicker::get([
            'name' => 'button_icon',
            'label' => __('Button Icon'),
            'value' => $widget_saved_values['button_icon'] ?? 'fa far-star',
        ]);

        $output .= Text::get([
            'name' => 'button_url',
            'label' => __('Button Url'),
            'value' => $widget_saved_values['button_url'] ?? null,
        ]);
        $output .= Image::get([
            'name' => 'background_image',
            'label' => __('Background Image'),
            'value' => $widget_saved_values['background_image'] ?? null,
            'dimensions' => '1920x1595'
        ]);

        $output .= Image::get([
            'name' => 'right_image',
            'label' => __('Right Image'),
            'value' => $widget_saved_values['right_image'] ?? null,
            'dimensions' => '690x950'
        ]);
        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 225,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 220,
            'max' => 500,
        ]);
        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    /**
     * @inheritDoc
     */
    public function frontend_render()
    {
        $settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();

        $background_image = render_background_image_markup_by_attachment_id($settings['background_image']);
        $right_image = render_image_markup_by_attachment_id($settings['right_image']);
        $title = SanitizeInput::esc_html($settings['title_'.$current_lang]);
        $description = SanitizeInput::esc_html($settings['description_'.$current_lang]);
        $button_text = SanitizeInput::esc_html($settings['button_text_'.$current_lang]);
        $button_icon = SanitizeInput::esc_html($settings['button_icon']);
        $button_url = SanitizeInput::esc_url($settings['button_url']);
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);
        return <<<HTML
<div class="header-slider-wrapper cdesign-home" {$background_image} >
    <div class="header-area cdesign-agency-home" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="header-inner">
                        <h1 class="title">{$title}</h1>
                        <p class="description">{$description}</p>
                    </div>
                </div>
                <div class="col-lg-6 >
                    <div class="right-image-wrap newRightImage">
                        {$right_image}
                    </div>
                </div>
                <div class="col-lg-12" >
                    <form action="{{ route('frontend.book') }}" class="d-none d-md-none" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="row" >
                        <div class="col-lg-5 px-0">
                            <div class="form-group" >
                                <input type="text" class="form-control newInput fromloc locs" required name="pickup" placeholder="Pickup Address" >
                            </div>
                        </div>
                        <div class="col-lg-4 px-0">
                            <div class="form-group" >
                                <input type="text" class="form-control newInput toloc locs" required name="destination" placeholder="Destination" >
                            </div>
                        </div>
                        <div class="col-lg-3 px-4">
                            <button type="submit" class="btn-dagency w-100 newBtn border-0">
                                Check Prices
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="col-lg-12" >
                    <form action="{{ route('frontend.book') }}" class="d-none d-md-block" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="row" >
                            <div class="col-lg-4">
                                <div class="form-group" >
                                    <input type="text" class="form-control newInput locs" style="border: 2px solid gainsboro;" required name="pickup" placeholder="Pickup Address" >
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group" >
                                    <input type="text" class="form-control newInput locs" style="border: 2px solid gainsboro;" required name="destination" placeholder="Destination" >
                                </div>
                            </div>
                            <div class="col-lg-4 px-4">
                                <button type="submit" class="btn-dagency w-100 newBtn border-0">
                                    Check Prices
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
HTML;

    }

    /**
     * @inheritDoc
     */
    public function addon_title()
    {
       return __('Header: 06');
    }
}