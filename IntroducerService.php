<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * http://www.ec-cube.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\Introducer\Service;

use Plugin\Introducer\Repository;

/**
 * Class IntroducerService.
 */
class IntroducerService
{
    /**
     * @var IntroducerRepository
     */
    private $introducerRepository;

     /**
     * @var DiscountrateRepository
     */
    private $discountrateRepository;

     /**
     * @var RebaterateRepository
     */
    private $rebaterateRepository;

    /**
     * IntroducerService constructor.
     *
     * @param IntroducerRepository $introducerRepository
     */
    public function __construct(
		IntroducerRepository $introducerRepository,
		DiscountrateRepository $discountrateRepository,
		RebaterateRepository $rebaterateRepository
	)
    {
        $this->IntroducerRepository = $introducerRepository;
        $this->DiscountrateRepository = $discountrateRepository;
        $this->RebaterateRepository = $rebaterateRepository;
    }

    /**
     * 新規登録する
     *
     * @param $data
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function createIntroducer($data)
    {
        // 詳細情報を生成する
        $Introducer = $this->newIntroducer($data);

        return $this->IntroducerRepository->saveIntroducer($Introducer);
    }

    /**
     * 新規登録する
     *
     * @param $data
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function createDiscountrate($data)
    {
        // 詳細情報を生成する
        $Discountrate = $this->newDiscountrate($data);

        return $this->DiscountrateRepository->saveDiscountrate($Discountrate);
    }

    /**
     * 新規登録する
     *
     * @param $data
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function createRebaterate($data)
    {
        // 詳細情報を生成する
        $Rebaterate = $this->newRebaterate($data);

        return $this->RebaterateRepository->saveRebaterate($Rebaterate);
    }

    /**
     * 更新する
     *
     * @param $data
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function updateIntroducer($data)
    {
        // 情報を取得する
        $Introducer = $this->IntroducerRepository->find($data['id']);
        if (!$Introducer) {
            return false;
        }

        // 情報を書き換える
        $Introducer->setComment($data['intro_id']);
        $Introducer->set($data['']);

        // 情報を更新する
        return $this->IntroducerRepository->saveIntroducer($Introducer);
    }

    /**
     * 情報を生成する
     *
     * @param $data
     *
     * @return Introducer
     *
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function newIntroducer($data)
    {
        $rank = $this->IntroducerRepository->getMaxRank();

        $Introducer = new Introducer();
        $Introducer->setComment($data['intro_id']);
        $Introducer->set($data['']);
        $Introducer->setSortno(($rank ? $rank : 0) + 1);
        $Introducer->setVisible(true);

        return $Introducer;
    }
}
