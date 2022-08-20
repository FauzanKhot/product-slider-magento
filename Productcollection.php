<?php
namespace Ahy\One\Block;
class Productcollection extends \Magento\Framework\View\Element\Template
{
    protected $_productCollectionFactory;
    protected $_productIdArr = [1,2,3,4,5,100,7,8];
    protected $_product;
    protected $_imageBuilder;
    protected $_priceHelper;


    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,            
        \Magento\Framework\Pricing\Helper\Data $productPriceHelper,
        \Magento\Catalog\Block\Product\ImageBuilder $imageBuilder,
        array $data = []
    )
      {
             $this->_productCollectionFactory = $productCollectionFactory;   
             $this->_imageBuilder = $imageBuilder;
             $this->_priceHelper = $productPriceHelper;
            parent::__construct($context, $data);
      }


        public function getProductCollectionbyIds()
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addIdFilter($this->_productIdArr);
        return $collection;
    }
        
    public function getImage($product, $imageId, $attributes = [])
    {
        return $this->_imageBuilder->create($product, $imageId, $attributes);
    }
    public function getProductPriceHtml($product){
        $productPrice = $this->_priceHelper->currency($product->getFinalPrice(), true, false); 
        return $productPrice;
    }



}
