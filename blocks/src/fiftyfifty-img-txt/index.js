const { registerBlockType } = wp.blocks;
const { useBlockProps, RichText, InspectorControls, MediaUpload } = wp.blockEditor;
const { PanelBody, TextControl, ToggleControl, Button, ColorPalette } = wp.components;

registerBlockType("laser-vega/fiftyfifty-img-txt", {
    edit: ({ attributes, setAttributes }) => {
        const blockProps = useBlockProps({
            className: "fiftyfifty-img-txt-block",
            style: { backgroundColor: attributes.bgColor }
        });

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Block Settings">
                        <TextControl
                            label="Heading"
                            value={attributes.heading}
                            onChange={(val) => setAttributes({ heading: val })}
                        />
                        <TextControl
                            label="Subheading"
                            value={attributes.subheading}
                            onChange={(val) => setAttributes({ subheading: val })}
                        />
                        <TextControl
                            label="Button Text"
                            value={attributes.buttonText}
                            onChange={(val) => setAttributes({ buttonText: val })}
                        />
                        <TextControl
                            label="Button URL"
                            value={attributes.buttonUrl}
                            onChange={(val) => setAttributes({ buttonUrl: val })}
                        />
                        <ToggleControl
                            label="Reverse Layout"
                            checked={attributes.reverse}
                            onChange={(val) => setAttributes({ reverse: val })}
                        />
                        <p><strong>Background Color</strong></p>
                        <ColorPalette
                            value={attributes.bgColor}
                            onChange={(val) => setAttributes({ bgColor: val })}
                        />
                        <MediaUpload
                            onSelect={(media) => setAttributes({ imageUrl: media.url })}
                            allowedTypes={["image"]}
                            render={({ open }) => <Button onClick={open}>{attributes.imageUrl ? "Replace Image" : "Upload Image"}</Button>}
                        />
                    </PanelBody>
                </InspectorControls>

                <div {...blockProps}>
                    <div className={`flex ${attributes.reverse ? "lg:flex-row-reverse" : "lg:flex-row"}`}>
                        <div className="w-1/2">
                            {attributes.subheading && <p>{attributes.subheading}</p>}
                            <RichText
                                tagName="h2"
                                value={attributes.heading}
                                onChange={(val) => setAttributes({ heading: val })}
                                placeholder="Heading…"
                            />
                            <RichText
                                tagName="div"
                                value={attributes.content}
                                onChange={(val) => setAttributes({ content: val })}
                                placeholder="Content…"
                            />
                            {attributes.buttonText && (
                                <a href={attributes.buttonUrl} className="btn">{attributes.buttonText}</a>
                            )}
                        </div>
                        {attributes.imageUrl && (
                            <div className="w-1/2">
                                <img src={attributes.imageUrl} alt={attributes.heading || ""} />
                            </div>
                        )}
                    </div>
                </div>
            </>
        );
    },

    save: () => null
});
