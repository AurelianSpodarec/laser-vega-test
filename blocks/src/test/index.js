// const { __ } = wp.i18n;
const { useBlockProps, RichText, InspectorControls, MediaUpload } = wp.blockEditor;
const { PanelBody, TextControl, ToggleControl, Button, ColorPalette } = wp.components;

wp.blocks.registerBlockType("laser-vega/test", {
    edit: ({ attributes, setAttributes }) => {
        const {
            heading,
            subheading,
            content,
            buttonText,
            buttonUrl,
            imageUrl,
            reverse,
            bgColor
        } = attributes;

        const blockProps = useBlockProps({
            className: "fiftyfifty-img-txt-block",
            style: { backgroundColor: bgColor }
        });

        return (
            <>
               
                <InspectorControls>
                    <PanelBody title="Block Settings">
                        <TextControl
                            label="Heading"
                            value={heading}
                            onChange={(val) => setAttributes({ heading: val })}
                        />
                        <TextControl
                            label="Subheading"
                            value={subheading}
                            onChange={(val) => setAttributes({ subheading: val })}
                        />
                        <TextControl
                            label="Button Text"
                            value={buttonText}
                            onChange={(val) => setAttributes({ buttonText: val })}
                        />
                        <TextControl
                            label="Button URL"
                            value={buttonUrl}
                            onChange={(val) => setAttributes({ buttonUrl: val })}
                        />
                        <ToggleControl
                            label="Reverse Layout"
                            checked={reverse}
                            onChange={(val) => setAttributes({ reverse: val })}
                        />
                        <p><strong>Background Color</strong></p>
                        <ColorPalette
                            value={bgColor}
                            onChange={(val) => setAttributes({ bgColor: val })}
                        />
                        <MediaUpload
                            onSelect={(media) => setAttributes({ imageUrl: media.url })}
                            allowedTypes={["image"]}
                            render={({ open }) => (
                                <Button onClick={open} isPrimary>
                                    {imageUrl ? "Replace Image" : "Upload Image"}
                                </Button>
                            )}
                        />
                    </PanelBody>
                </InspectorControls>

                {/* Editor Preview */}
                <div {...blockProps}>
                    <div className={`flex ${reverse ? "lg:flex-row-reverse" : "lg:flex-row"}`}>
                        <div className="w-1/2">
                            {subheading && <p>{subheading}</p>}
                            <RichText
                                tagName="h2"
                                value={heading}
                                onChange={(val) => setAttributes({ heading: val })}
                                placeholder="Heading..."
                            />
                            <RichText
                                tagName="div"
                                value={content}
                                onChange={(val) => setAttributes({ content: val })}
                                placeholder="Content..."
                            />
                            {buttonText && (
                                <a href={buttonUrl} className="btn">
                                    {buttonText}
                                </a>
                            )}
                        </div>
                        {imageUrl && (
                            <div className="w-1/2">
                                <img src={imageUrl} alt={heading || ""} />
                            </div>
                        )}
                    </div>
                </div>
            </>
        );
    },

    save: () => {
        // Dynamic block → handled by render.php
        return null;
    }
});
